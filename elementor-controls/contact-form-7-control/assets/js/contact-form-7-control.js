window.addEventListener( 'elementor/init', () => {

    var contactFormSeven = elementor.modules.controls.BaseData.extend({ 

        onReady: function() {

            var self = this;
            var select = this.el.querySelector('.boxshadow-contact-form-seven');
            
            select.addEventListener('change', function(event) {
                
                self.saveValue();

            });

        },

        saveValue: function() {

            var select = this.el.querySelector('.boxshadow-contact-form-seven');

            if( select.value == '' || select.value == null ) return;

            this.setValue(select.value);

        },

        onBeforeDestroy: function() {
            
            this.saveValue();

        }

    });

    elementor.addControlView( 'BOXSHADOW_CONTACT_FORM_7', contactFormSeven );

} );