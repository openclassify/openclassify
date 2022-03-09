(function($)
{
	$.Redactor.prototype.definedlinks = function()
	{
		return {
			init: function()
			{
				if (!this.opts.definedLinks)
				{
					return;
				}

				this.modal.addCallback('link', $.proxy(this.definedlinks.load, this));

			},
			load: function()
			{
				var $section = $('<section />');
				var $select = $('<select id="redactor-defined-links" />');

				$section.append($select);
				this.modal.getModal().prepend($section);

				this.definedlinks.storage = {};

				var url = (this.opts.definedlinks) ? this.opts.definedlinks : this.opts.definedLinks;
				$.getJSON(url, $.proxy(function(data)
				{
					$.each(data, $.proxy(function(key, val)
					{
						this.definedlinks.storage[key] = val;
						$select.append($('<option>').val(key).html(val.name));

					}, this));

					$select.on('change', $.proxy(this.definedlinks.select, this));

				}, this));

			},
			select: function(e)
			{
				var oldText = $.trim($('#redactor-link-url-text').val());

				var key = $(e.target).val();
				var name = '', url = '';
				if (key !== 0)
				{
					name = this.definedlinks.storage[key].name;
					url = this.definedlinks.storage[key].url;
				}

				$('#redactor-link-url').val(url);

				if (oldText === '')
				{
					$('#redactor-link-url-text').val(name);
				}

			}
		};
	};
})(jQuery);