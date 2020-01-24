'use strict';

var HW = {};
var hw;

HW = function() {
	this.init();
};

(function($, window, document, undefined) {

	HW.prototype = {
		/**
		 * 初期設定
		 */
		init: function() {
			var base = this;
			var $window = $(window);

			// スクロール位置の保時
			base.scrollTop = 0;

			// トップへ戻るボタン
			base.$topBack = $('.top-back');
			base.fixedSwitch();

			// スムーススクロール実行
			base.smoothScroll('.js-goto-pagetop', {forthTop: true});
			base.smoothScroll('a[href^="#"]');

			base.breakpointClassSwitch();

			// JS Menu
			$('.js-menu').on('click', function(e) {
				e.preventDefault();
				var $body = $('body'),
					$menuButton = $('.sp-button__icon');
				if ($body.hasClass('is-open')) { // Close
					$body.removeClass('is-open').removeAttr('style');
					$menuButton.removeClass('close');
				} else { // Open
					base.scrollTop = $(window).scrollTop();
					$body.addClass('is-open');
					$menuButton.addClass('close');
				}
			});

			// スクロール時のイベント
			$window.on('scroll', function() {
				base.fixedSwitch();
			});

			// リサイズ時に動くイベント
			$window.on('resize', _.throttle(250, function() {
				base.breakpointClassSwitch();
			}));

			// window on load イベント
			$window.on('load', function() {
				base.windowOnloadInit();
			});
		},

		/**
		 * Window on load設定
		 */
		windowOnloadInit: function() {
			// var base = this;
		},

		/**
		 * スムーススクロール
		 */
		smoothScroll: function(selector, options) {
			var c = $.extend({
				speed: 650,
				easing: 'swing',
				adjust: 0,
				forthTop: false
			}, options);
			$(selector).on('click.smoothScroll', function(e) {
				e.preventDefault();
				var elmHash = $(this).attr('href');
				var targetOffset;
				if (elmHash === '#') { return; }
				targetOffset = (c.forthTop) ? 0 : $(elmHash).animate({scrollTop: 0}, 1000) - c.adjust;
				$('html,body').animate({scrollTop: targetOffset}, c.speed, c.easing);
			});
		},

		breakpointClassSwitch: function() {
			var base = this;
			if (base.isSPSize()) {
				$('body').removeClass('isPC').addClass('isSP');
			} else {
				$('body').removeClass('isSP is-open').addClass('isPC');
				$('.sp-button__icon').removeClass('close');
			}
		},

		fixedSwitch: function() {
			var base = this;
			var $window = $(window);

			if ($window.scrollTop() > 100) {
				base.$topBack.addClass('show');
			} else {
				base.$topBack.removeClass('show');
			}
		},


		/**
		 * Is SP Size
		 */
		isSPSize: function() {
			return ($(window).width() <= 768) ? true : false ;
		}
	};

})(jQuery, window, document);

hw = new HW();
