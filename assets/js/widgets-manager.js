/**
 * Elementor widgets manager screen.
 * Search filter, bulk toggles and the enabled counter.
 */
(function ($) {
	'use strict';

	$(function () {
		var $form = $('#elemental-widgets-manager-form');

		if (!$form.length) {
			return;
		}

		var $items = $form.find('.elemental-widgets-item');
		var $inputs = $form.find('.elemental-widgets-item__input');
		var $counter = $('#elemental-widgets-enabled-count');

		function updateCount() {
			$counter.text($inputs.filter(':checked').length);
		}

		function setChecked($targets, state) {
			$targets.prop('checked', state);
			updateCount();
		}

		$inputs.on('change', updateCount);

		$form.find('[data-elemental-bulk]').on('click', function () {
			var mode = $(this).data('elemental-bulk');
			// Only touch what is currently visible so the search acts as a scope.
			var $visible = $items.not('[hidden]');

			if ('recommended' === mode) {
				$visible.each(function () {
					var $item = $(this);
					$item.find('.elemental-widgets-item__input').prop('checked', 1 === $item.data('recommended'));
				});
				updateCount();
				return;
			}

			setChecked($visible.find('.elemental-widgets-item__input'), 'enable' === mode);
		});

		$form.find('[data-elemental-group-bulk]').on('click', function () {
			var state = 'enable' === $(this).data('elemental-group-bulk');
			var $group = $(this).closest('.elemental-widgets-group');

			setChecked($group.find('.elemental-widgets-item').not('[hidden]').find('.elemental-widgets-item__input'), state);
		});

		$('#elemental-widgets-search').on('input', function () {
			var term = $.trim(this.value).toLowerCase();

			$items.each(function () {
				var matches = !term || -1 !== String($(this).data('search')).indexOf(term);
				$(this).prop('hidden', !matches);
			});

			$form.find('.elemental-widgets-group').each(function () {
				var $group = $(this);
				var visible = $group.find('.elemental-widgets-item').not('[hidden]').length;

				$group.find('.elemental-widgets-group__empty').prop('hidden', 0 !== visible);
			});
		});

		updateCount();
	});
})(jQuery);
