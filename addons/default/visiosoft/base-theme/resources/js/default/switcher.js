		jQuery(document).ready(function($){
			$('.preset-list li a').on('click',function(event){
				event.preventDefault();
				var color = $(this).data('color'),
					url = 'css/presets/'+color+'.css';
					logoSrc = 'images/presets/'+color+'/logo.png';
					ctaIconSrc = 'images/presets/'+color+'/13.png';
					ctaIconSrc2 = 'images/presets/'+color+'/14.png';
					ctaIconSrc3 = 'images/presets/'+color+'/15.png';
					ctaIconSrc4 = 'images/presets/'+color+'/logo3.png';
					ctaIconSrc5 = 'images/presets/'+color+'/31.png';
					ctaIconSrc6 = 'images/presets/'+color+'/32.png';
					ctaIconSrc7 = 'images/presets/'+color+'/33.png';					
					
				$('.navbar-brand img').attr('src', logoSrc);
				$('.cta-icon.icon-secure img').attr('src', ctaIconSrc);
				$('.cta-icon.icon-support img').attr('src', ctaIconSrc2);
				$('.cta-icon.icon-trading img').attr('src', ctaIconSrc3);
				$('.about-title .logo-intro img').attr('src', ctaIconSrc4);
				$('#preset').attr('href', url);
				$('.cta-icon.icon-jobs img').attr('src', ctaIconSrc5);
				$('.cta-icon.icon-company img').attr('src', ctaIconSrc6);
				$('.cta-icon.icon-candidate img').attr('src', ctaIconSrc7);				
			});

			$('.style-chooser .toggler').on('click', function(event){
				event.preventDefault();
				$(this).closest('.style-chooser').toggleClass('opened');
			});
		});