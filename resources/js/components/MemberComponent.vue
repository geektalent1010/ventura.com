
<template>
	<div class="member-item" :attr-fullname="memberProfile.first_name + ' ' + memberProfile.last_name">
    <a class="member-link" :href="'/profile/' + memberInfo.id">
      <div class="member-avatar-wrp">
        <img class="member-avatar" v-if="memberProfile && memberProfile.main_avatar_url" :src="asset('uploads/' + memberInfo.username + '/' + memberProfile.main_avatar_url)" alt="member avatar">
        <div class="member-avatar" v-if="memberProfile && memberProfile.main_avatar_url === null">
          <p class="first_letter">{{ memberInfo.user_type == 1 ? memberProfile.company_name ? memberProfile.company_name.substr(0, 1) : 'C' : memberProfile.first_name.substr(0, 1) }}</p>
        </div>
      </div>
      <div class="member-name">{{ memberInfo.user_type == 1 ? memberProfile.company_name ? memberProfile.company_name : 'Company ' + memberInfo.id : memberProfile.first_name + ' ' + memberProfile.last_name }}</div>
    </a>
    <div class="notification-section">
      <div class="unread-message-notify" :class="{ 'offline-status': !onlineStatus, 'online-status': onlineStatus }">
        <div class="unread-messages-number" v-if="unreadMessages != 0">{{unreadMessages}}</div>
      </div>
	   <a class="message-icon-btn" :href="authUser.id + '_' + memberInfo.id">
			<img class="message-icon" :src="asset('images/svg/IconCHAT.svg')">
		</a>
      <div class="disconnect-icon-btn" :attr-channelId="channelInfo.id">
        <span class="disconnect-icon"><i class="fa fa-trash" aria-hidden="true"></i></span>
      </div>
    </div>
  </div>
</template>

<script>
	export default {
		name: "MemberComponent",
		props: {
			authUser: {
				type: Object,
				required: true
			},
			channelInfo: {
				type: Object,
				required: true
			},
			memberInfo: {
				type: Object,
				required: true
			},
			memberProfile: {
				type: Object,
				required: true
			},
			currentChannel: {
				type: Boolean,
			},
			onlineStatus: {
				type: Boolean,
			}
		},
		data() {
			return {
				unreadMessages: 0,
				lastReadedAt: this.channelInfo.last_message_readed_at,
				channel: ""
			};
		},
		async created() {
			const token = await this.fetchToken();
			await this.initializeClient(token);
			await this.fetchMessages();
		},
		methods: {
      formatTime(date) {
      	const lastMessageDate = moment(moment.utc(date).format('DD/MM/yyyy'));

	      var REFERENCE = moment(moment.utc(new Date()).format('DD/MM/yyyy'));
				var TODAY = REFERENCE.clone().startOf('day');
				var YESTERDAY = REFERENCE.clone().subtract(1, 'days').startOf('day');
				var A_WEEK_OLD = REFERENCE.clone().subtract(7, 'days').startOf('day');

				if (lastMessageDate.isSame(TODAY, 'd')) {
					return moment(moment.utc(date).toDate()).format('HH:mm');
				}
				if (lastMessageDate.isSame(YESTERDAY, 'd')) {
					return 'yesterday';
				}
				if (lastMessageDate.isAfter(A_WEEK_OLD)) {
					return moment(moment.utc(date).toDate()).format('ddd');
				}
				return moment(moment.utc(date).toDate()).format('DD/MM/yyyy');
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
				this.channel.on("messageAdded", async() => {
				  await this.fetchMessages();
				});
			},
			async fetchMessages() {
				const lastMessageSid = this.channelInfo.last_read_message_sid;
				const data = (await this.channel.getMessages()).items;
				if (data.length) {
					const reverseData = data.reverse();
					if (lastMessageSid) {
						const targetIndex = reverseData.findIndex(item => item.sid == lastMessageSid);
						if (targetIndex) {
							this.unreadMessages = reverseData.filter((item, index) => index < targetIndex).length;
						}
					} else {
						this.unreadMessages = data.length;
					}
				}
			},
		}
	};
</script>
