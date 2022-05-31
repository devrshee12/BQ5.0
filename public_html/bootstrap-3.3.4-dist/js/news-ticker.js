$(function() {
				var _scroll = {
					delay: 1000,
					easing: 'linear',
					items: 1,
					duration: 0.05,
					timeoutDuration: 0,
					pauseOnHover: 'immediate'
				};
				$('#ticker-1').carouFredSel({
					width: 1000,
					align: false,
                                          infinite: true, 
                                        direction: "left", 
					items: {
						width: 'variable',
						height: 25,
						visible: 2
					},
					scroll: _scroll
				});

				$('#ticker-2').carouFredSel({
					width: 1000,
					align: false,
                                     infinite: true, 
                                        direction: "right", 
					//circular: true,
					items: {
                                                width: 'variable',
						height: 25,
						visible: 1 
                                            },
					scroll: _scroll
				});
                                $('#ticker-3').carouFredSel({
					width: 1000,
					align: false,
                                          infinite: true, 
                                        direction: "up", 
					items: {
						width: 'variable',
						height: 25,
						visible: 2
					},
					scroll: _scroll
				});

				//	set carousels to be 100% wide
				$('.caroufredsel_wrapper').css('width', '100%');

				//	set a large width on the last DD so the ticker won't show the first item at the end
				$('#ticker-3 ').width(2000);
			});