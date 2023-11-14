<template>
  <div class="messages-content">
		<div class="messages-section flat-scroll" ref="messagesContainer">
			<div v-for="group in groupedByDate" v-bind:key="group.date">
				<div class="message-group-date">{{ group.date }}</div>
				<div v-for="message in group.messages" v-bind:key="message.id">
					<div class="message-item" :class="{ 'my-message': message.author === user.username }">
						<div class="message-body">
							<div class="message-content text-capitalize">{{ message.author }}</div>
                            <div class="d-flex mt-1">
                                <div class="message-content">{{ message.body }}</div>
                                <div class="message-time">{{ formatTime(message.timestamp) }}</div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="message-input-section">
		  <textarea
				type="text"
				v-model="newMessage"
				class="form-control flat-scroll"
				placeholder="Type here"
		  />
		  <div class="send-button-section" @click="sendMessage">
		  	<span class="send-icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
		  </div>
		</div>
	</div>
</template>

<script>
export default {
  name: "GroupChatRoom",
  props: {
      user: {
          type: Object,
          required: true
      },
      channelInfo: {
          type: Object,
          required: true
      }
  },
  data() {
      return {
          groupedByDate: [],
          members: [],
          messages: [],
          newMessage: '',
          channel: '',
          member: '',
          isBanned: false,
          adminRoleSid: process.env.MIX_CHANNEL_ADMIN_ROLE_SID,
          memberRoleSid: process.env.MIX_CHANNEL_MEMBER_ROLE_SID,
          bannedRoleSid: process.env.MIX_CHANNEL_BANNED_ROLE_SID
      }
  },
  async created() {
      const token = await this.fetchToken()

      await this.initializeClient(token)
      await this.fetchMessages()
  },
  updated() {
      this.$nextTick(() => this.scrollToEnd());
  },
  methods: {
      scrollToEnd: function () {
        var content = this.$refs.messagesContainer;
        content.scrollTop = content.scrollHeight
      },
      formatTime(date) {
        return moment(moment.utc(date).toDate()).format('HH:mm');
      },
      async fetchToken() {
          const { data } = await axios.post('/api/token', {
              email: this.user.username
          })

          return data.token
      },
      async initializeClient(token) {
          const client = await Twilio.Chat.Client.create(token)

          client.on("tokenAboutToExpire", async () => {
              const token = await this.fetchToken()

              client.updateToken(token)
          })

          this.channel = await client.getChannelBySid(
            `${this.channelInfo.channel_unique_name}`
          )
          this.members = await this.channel.getMembers()
          this.member = await this.channel.getMemberByIdentity(this.user.username)

          this.channel.on("messageAdded", async(message) => {
            await this.fetchMessages();
          });

          this.channel.on('memberJoined', (member) => {
              this.members.push(member)
          })

          this.channel.on('memberLeft', (member) => {
              this.members = this.members.filter((mem) => mem.sid !== member.sid)

              if (member.identity === this.user.username) {
                  window.location = '/home'
              }
          })

          this.channel.on("memberUpdated", ({ member }) => {
              if (member.identity === this.user.username && member.roleSid === this.bannedRoleSid) {
                  this.isBanned = true
              }

              if (member.identity === this.user.username && member.roleSid === this.memberRoleSid) {
                  this.isBanned = false
              }
          })
      },
      async fetchMessages() {
          // this.messages = (await this.channel.getMessages()).items
          const data = (await this.channel.getMessages()).items;
          const groups = data.reduce((groups, item) => {
				  const date = moment(moment.utc(item.timestamp).toDate()).format('DD/MM/yyyy');
				  if (!groups[date]) {
						groups[date] = [];
				  }
				  groups[date].push(item);
				  return groups;
				}, {});

				this.groupedByDate = Object.keys(groups).map((date) => {
				  return {
						date,
						messages: groups[date]
				  };
				});
      },
      sendMessage() {
          this.channel.sendMessage(this.newMessage)
          this.newMessage = ''
      },
      async removeMember(identity) {
          await this.channel.removeMember(identity)
      },
      async banMember(identity) {
          await axios.post(`/api/members/${identity}/ban`)
      },
      async unbanMember(identity) {
          await axios.post(`/api/members/${identity}/unban`)
      }
  }
}
</script>
