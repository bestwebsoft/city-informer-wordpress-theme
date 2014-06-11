( function( $ ) {
	$(document).ready( function() {
	/* *** *** Create radio *** *** */
		if( $( this ).find( 'input[type="radio"]' ) ) {
			var fakeContainer = $( '<span class="city_informer-fake-radio-container" />' );
			var fakeRadio = $( '<span class="city_informer-fake-radio" />' );
			var contRadioItem = $( '<div class="city_informer-radio-item-container" />' );
			$( this ).each( function( k, city_informerRadio ) {
				$( city_informerRadio ).find( '.radio' ).removeClass( 'radio' ).addClass( 'city_informer-radio-custom' );
				$( city_informerRadio ).find( 'input[type="radio"]' ).wrap( fakeContainer );
				var label = $( city_informerRadio ).find( '.city_informer-fake-radio-container' ).next().detach(); /* remove all labels and save in variable */
				$( city_informerRadio ).find( '.city_informer-fake-radio-container' ).wrap( contRadioItem );
				$( city_informerRadio ).find( '.city_informer-radio-item-container' ).each( function() { /* separate label for each radio */
					var radioContainer = this;
					$( label ).each(function() {
						if ( $( this ).attr( 'for' ) ==  $( radioContainer ).find( 'input' ).attr( 'id' ) ) {
							$( radioContainer ).append( $( this ) );
						}
					});
				});
				$( city_informerRadio ).find( '.city_informer-fake-radio-container' ).append( fakeRadio );
				/* if radio was selected */
				$( city_informerRadio ).find( 'input[type=radio]:checked' ).next().addClass( 'selected' );
				/* if radio is disabled */
				$( city_informerRadio ).find( 'input[type=radio]' ).each( function() {
					if( $( this ).attr( 'disabled' ) ) {
						$( this ).next().addClass( 'disabled' );
					}
				});
				/* events handlers */
				$( city_informerRadio ).find( 'input[type="radio"]' ).on( 'click', function(){
					$( city_informerRadio ).find( 'input[name="' + $( this ).attr( 'name' ) + '"]' ).next().removeClass( 'selected' );
					$( this ).parent().find( '.city_informer-fake-radio' ).addClass( 'selected' );
				});
				$( city_informerRadio ).find( '.city_informer-fake-radio' ).on( 'click', function(){
					if( ! $( this ).prev().attr( 'disabled' ) ) {
						$( this ).prev().trigger( 'click' );
					}
				});
			});
		}
		/* *** *** Create checkboxes *** *** */
		if( $( this ).find( 'input[type="checkbox"]' ) ) {
			var fakeContainerCheck = $( '<span class="city_informer-fake-checkbox-container" />' );
			var fakeCheckbox = $( '<span class="city_informer-fake-checkbox" />' );
			var contCheckboxItem = $( '<div class="city_informer-checkbox-item-container" />' );
			$( this ).each(function( k, city_informerCheckbox ) {
				$( city_informerCheckbox ).find( '.checkbox' ).removeClass( 'checkbox' ).addClass( 'city_informer-checkbox-custom' );
				$( city_informerCheckbox ).find( 'input[type="checkbox"]' ).wrap( fakeContainerCheck );
				$( city_informerCheckbox ).find( '.city_informer-fake-checkbox-container' ).wrap( contCheckboxItem );
				$( city_informerCheckbox ).find( '.city_informer-checkbox-item-container' ).each( function() { /* separate label for each checkbox */
					var checkboxContainer = this;
					$( checkboxContainer ).next().each(function() {
						if( $( this ).attr( 'for' ) ==  $( checkboxContainer ).find( 'input' ).attr( 'id' ) ) {
							$( checkboxContainer ).append( $( this ) );
						}
					});
				});
				$( city_informerCheckbox ).find( '.city_informer-fake-checkbox-container' ).append( fakeCheckbox );
				/* if checkbox was selected */
				$( city_informerCheckbox ).find( 'input[type=checkbox]:checked' ).next().addClass( 'selected' );
				/* if checkbox is disabled */
				$( city_informerCheckbox ).find( 'input[type=checkbox]' ).each( function() {
					if( $( this ).attr( 'disabled' ) ) {
						$( this ).next().addClass( 'disabled' );
					}
				});
				/* events handlers */
				$( city_informerCheckbox ).find( 'input[type="checkbox"]' ).on( 'click', function(){
					var fCh = $( this ).parent().find( '.city_informer-fake-checkbox' );
					if( fCh.hasClass( 'selected' ) ) {
						fCh.removeClass( 'selected' );
					} else {
						fCh.addClass( 'selected' );
					}
				});
				$( city_informerCheckbox ).find( '.city_informer-fake-checkbox' ).on( 'click', function(){
					if( ! $( this ).prev().attr( 'disabled' ) ) {
						$( this ).prev().trigger( 'click' );
					}
				});
			});
		}
	/* *** *** Create clear button *** *** */
		$( this ).find( 'input[type="reset"]' ).click( function() {
			var city_informerForms = $( this ).parents( 'form' ).first();
			city_informerForms.find( '.city_informer-select-block' ).find( '.city_informer-option.index-0' ).click();
			city_informerForms.find( '.city_informer-fake-radio, .city_informer-fake-checkbox' ).removeClass( 'selected' );
			$( city_informerForms )[0].reset();
			city_informerForms.find( 'input[type="file"]' ).change();
			e.preventDefault;
		});
	});
} )( jQuery );    
 