import $ from 'jquery';

export default class Menu {
	constructor( id ) {
		this.id = id;
		this.$el = $( '#' + id );
		this.$controller = $( '[aria-controls="' + this.id + '" ]' );
		this.$body = $( 'body' );
		this.on();
	}

	on() {
		this.$controller.on( 'click', this.toggle.bind( this ) );
		this.$el.children().on( 'click', function( event ) {
			event.stopPropagation();
		} );

		$( document ).on( 'keyup', ( event ) => {
			if ( event.keyCode === 27 ) {
				this.close();
			}
		} );

		this.$el.on( 'transitionend', this.transitionend.bind( this ) );
	}

	transitionend() {
		this.$el.removeClass( 'is-animated' );
	}

	toggle( event ) {
		event.preventDefault();
		if ( this.$controller.attr( 'aria-expanded' ) === 'false' ) {
			this.open();
		} else {
			this.close();
		}
	}

	open() {
		this.$el.addClass( 'is-animated' );
		this.$el.attr( 'aria-expanded', 'true' );
		//this.$el.attr('aria-hidden',"false");
		this.$controller.attr( 'aria-expanded', 'true' );
		this.$body.addClass( 'state-menu-open' );
	}

	close() {
		this.$el.addClass( 'is-animated' );
		this.$el.attr( 'aria-expanded', 'false' );
		//this.$el.attr('aria-hidden',"true");
		this.$controller.attr( 'aria-expanded', 'false' );
		this.$body.removeClass( 'state-menu-open' );
	}
}
