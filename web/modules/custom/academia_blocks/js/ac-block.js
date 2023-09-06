/* 
 * Here comes the text of your license
 * Each line should be prefixed with  * 
 */

(function ($, Drupal, once) {
    $(document).ready(function () {
        $('.academia-block-camera-slider').camera({
            height: '32%',
            pagination: true,
            thumbnails: false,
            loader:'none',
<<<<<<< HEAD
            fx:'simpleFade',
            imagePath:'sites/all/modules/custom/academia_blocks/images/'
        });  
      console.dir('Drupal',Drupal);
    });
    Drupal.behaviors.blockCameraSlide = {
        attach: function attach(context, settings) {
console.dir('Drupal',settings);
=======
        });  
      
    });
    Drupal.behaviors.blockCameraSlide = {
        attach: function attach(context, settings) {

>>>>>>> 8cbe71884b5fce84cfda866a9fe2c9537edf48dc


        }
    };
})(jQuery, Drupal, once);
