<template>
<div class="notifications">
	<div class="container">
    	<div :class="typeClass" v-show="show" role="alert">
    		<span v-html="body">{{ body }}</span>    	
    		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
			</button>
		</div>
    </div>
</div>
</template>

<script>
export default {
	props: ["message", "type", "dontHide"],

	data() {
		return {
			body: "",
			typeClass: "",
			show: false
		};
	},

	created() {
		const context = this;

		if (this.message && this.type) {
			this.flash(this.message, this.type, this.dontHide);
		}

		window.events.$on("flash", function(message, type) {
			context.flash(message, type);
		});
	},

	methods: {
		flash(message, type, dontHide = false) {

			if (! type) {
				type = "info";
			}

			this.body = message;
			this.typeClass = "alert-dismissible alert alert-" + type;
			this.show = true;

			if(! dontHide) {
				this.hide();
			}
    	},

		hide() {
			setTimeout(() => {
				this.show = false;
			}, 3000);
		}
	}
};
</script>
