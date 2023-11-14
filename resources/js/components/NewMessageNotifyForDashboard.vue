
<template>
  <div class="notification-section" v-if="unreadMessages != 0">
		<span class="notify-status blinking"><i class="fa-solid fa-circle"></i></span>
  </div>
</template>

<script>
	export default {
		name: "NewMessageNotifyForDashboard",
		props: {
			authUser: {
				type: Object,
				required: true
			},
			channelInfo: {
				type: Object,
				required: true
			},
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
