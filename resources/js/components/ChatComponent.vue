
<template>
	<div class="messages-content">
		<div class="messages-section flat-scroll" ref="messagesContainer">
			<div v-for="group in groupedByDate" v-bind:key="group.date">
				<div class="message-group-date">{{ group.date }}</div>
				<div v-for="message in group.messages" v-bind:key="message.id">
					<div class="message-item" :class="{ 'my-message': message.author === authUser.email }">
						<div class="message-body">
							<div class="message-content">{{ message.body }}</div>
						  <div class="message-time">{{ formatTime(message.timestamp) }}</div>
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
		name: "ChatComponent",
		props: {
			authUser: {
				type: Object,
				required: true
			},
			channelInfo: {
				type: Object,
				required: true
			},
			currentChannel: {
				type: Boolean,
			}
		},
		data() {
			return {
				groupedByDate: [],
				newMessage: "",
				channel: ""
			};
		},
		async created() {
			const token = await this.fetchToken();
			await this.initializeClient(token);
			await this.fetchMessages();
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
				const { data } = await axios.post("/api/token", {
					email: this.authUser.email
				});

				return data.token;
			},
			async initializeClient(token) {
				const client = await Twilio.Chat.Client.create(token);

				client.on("tokenAboutToExpire", async () => {
					const token = await this.fetchToken();

					client.updateToken(token);
				});

				this.channel = await client.getChannelByUniqueName(
					`${this.channelInfo.channel_unique_name}`
				);
				this.channel.on("messageAdded", async(message) => {
				  await this.fetchMessages();
				});
			},
			async fetchMessages() {
				const data = (await this.channel.getMessages()).items;
				if (data.length) {
					if (this.currentChannel) {
						await axios.post("/api/update-last-message-id", {
							channelId: this.channelInfo.id,
							messageSid: data[data.length - 1].sid,
							readedAt: data[data.length - 1].timestamp
						});
					}
				}

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
			  this.channel.sendMessage(this.newMessage);
			  this.newMessage = "";
			}
		}
	};
</script>
