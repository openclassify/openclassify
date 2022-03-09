(function($)
{
	$.Redactor.prototype.inlinestyle = function()
	{
		return {
			langs: {
				en: {
					"style": "Style"
				}
			},
			init: function()
			{
				var tags = {
					"marked": {
						title: "Marked",
						args: ['mark']
					},
					"code": {
						title: "Code",
						args: ['code']
					},
					"sample": {
						title: "Sample",
						args: ['samp']
					},
					"variable": {
						title: "Variable",
						args: ['var']
					},
					"shortcut": {
						title: "Shortcut",
						args: ['kbd']
					},
					"cite": {
						title: "Cite",
						args: ['cite']
					},
					"sup": {
						title: "Superscript",
						args: ['sup']
					},
					"sub": {
						title: "Subscript",
						args: ['sub']
					}
				};


				var that = this;
				var dropdown = {};

				$.each(tags, function(i, s)
				{
					dropdown[i] = { title: s.title, func: 'inline.format', args: s.args };
				});


				var button = this.button.addAfter('format', 'inline', this.lang.get('style'));
				this.button.addDropdown(button, dropdown);

			}


		};
	};
})(jQuery);