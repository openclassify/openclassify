(function($)
{
	$.Redactor.prototype.alignment = function()
	{
		return {
			langs: {
				en: {
    				"align": "Align",
					"align-left": "Align Left",
					"align-center": "Align Center",
					"align-right": "Align Right"
				}
			},
			init: function()
			{
				var that = this;
				var dropdown = {};

				dropdown.left = { title: that.lang.get('align-left'), func: that.alignment.setLeft };
				dropdown.center = { title: that.lang.get('align-center'), func: that.alignment.setCenter };
				dropdown.right = { title: that.lang.get('align-right'), func: that.alignment.setRight };

				var button = this.button.add('alignment', this.lang.get('align'));
				this.button.addDropdown(button, dropdown);
			},
			removeAlign: function()
			{
    		    this.block.removeClass('text-center');
    		    this.block.removeClass('text-right');
			},
			setLeft: function()
			{
				this.buffer.set();
				this.alignment.removeAlign();
			},
			setCenter: function()
			{
				this.buffer.set();
				this.alignment.removeAlign();
				this.block.addClass('text-center');
			},
			setRight: function()
			{
				this.buffer.set();
				this.alignment.removeAlign();
				this.block.addClass('text-right');
			}
		};
	};
})(jQuery);