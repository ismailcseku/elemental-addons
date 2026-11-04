/**
 * Visual skins manager screen.
 */
(function ($) {
	'use strict';

	$(function () {
		var $form = $('#elemental-skins-manager-form');

		if (!$form.length) {
			return;
		}

		var $cards = $form.find('.elemental-skins-card');
		var $inputs = $form.find('.elemental-skins-card__input');
		var $counter = $('#elemental-skins-enabled-count');

		function syncCardState($input) {
			$input.closest('.elemental-skins-card').toggleClass('is-enabled', $input.is(':checked'));
		}

		function updateCount() {
			$counter.text($inputs.filter(':checked').length);
		}

		function setChecked($targets, state) {
			$targets.prop('checked', state).each(function () {
				syncCardState($(this));
			});
			updateCount();
		}

		$inputs.on('change', function () {
			syncCardState($(this));
			updateCount();
		});

		$form.find('[data-elemental-bulk]').on('click', function () {
			var mode = $(this).data('elemental-bulk');
			var $visible = $cards.not('[hidden]');

			if ('recommended' === mode) {
				$visible.each(function () {
					var $card = $(this);
					var $input = $card.find('.elemental-skins-card__input');
					$input.prop('checked', 1 === $card.data('recommended'));
					syncCardState($input);
				});
				updateCount();
				return;
			}

			setChecked($visible.find('.elemental-skins-card__input'), 'enable' === mode);
		});

		$form.find('[data-elemental-group-bulk]').on('click', function () {
			var state = 'enable' === $(this).data('elemental-group-bulk');
			var $group = $(this).closest('.elemental-skins-group');
			setChecked($group.find('.elemental-skins-card').not('[hidden]').find('.elemental-skins-card__input'), state);
		});

		$('#elemental-skins-search').on('input', function () {
			var term = $.trim(this.value).toLowerCase();

			$cards.each(function () {
				var matches = !term || -1 !== String($(this).data('search')).indexOf(term);
				$(this).prop('hidden', !matches);
			});

			$form.find('.elemental-skins-group').each(function () {
				var $group = $(this);
				var visible = $group.find('.elemental-skins-card').not('[hidden]').length;
				$group.find('.elemental-skins-group__empty').prop('hidden', 0 !== visible);
			});
		});

		updateCount();
	});
})(jQuery);
