window.addEventListener( 'elementor/init', () => {

    var contactForm = elementor.modules.controls.BaseData.extend({ 

        onReady: function() {

            var self = this;
            var checkboxes = this.el.querySelectorAll('.boxshadow-contact-form');

            for(var i= 0; i < checkboxes.length; i++) {

                checkboxes[i].addEventListener('change', function(event) {

                    self.saveValue();

                });
            }

        },

        saveValue: function() {

            var checkboxes = this.el.querySelectorAll('.boxshadow-contact-form');

            var dataObj = {};
            for(var i= 0; i < checkboxes.length; i++) {
                dataObj[checkboxes[i].name] = `${checkboxes[i].checked}`;
            }
            
            this.setValue(dataObj);

        },

        onBeforeDestroy: function() {
            
            this.saveValue();

        }

    });

    elementor.addControlView( 'BOXSHADOW_CONTACT_FORM', contactForm );

} );