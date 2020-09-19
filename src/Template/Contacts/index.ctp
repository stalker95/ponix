
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">


<div class="breadcrums">
	<div class="breadcrums_list">
		<p class="breadcrums_title">Контакти</p>
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  'index'],['fullBase' => true]) ?>">Головна</a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'contacts','action'    =>  'index/'], ['fullBase' => true]) ?>">Контакти</a>
			<span> / </span>
		</div>
	</div>
</div>
<section class="propose ">
	<div class="categories_page background_white container">
       <div class="container">
       	<div class="contacts_container about_container">
       		<div class="contacts_container_top">
       			<div class="contacts_container_item">
       				<div class="contacts_container_item_image">
       					<img src="<?= $this->Url->build('/img/map_contacts.svg', ['fullBase' => true]) ?>" alt="Contacts">
       				</div>
       				<div class="contacts_container_item_top">
       					<p>Наша адреса: </p>
       				</div>
       				<div class="contacts_container_item_bottom">
       					<p><?= $settings->address ?></p>
       				</div>
       			</div>
       			<div class="contacts_container_item">
       				<div class="contacts_container_item_image">
       					<img src="<?= $this->Url->build('/img/envelope_contacts.svg', ['fullBase' => true]) ?>" alt="Contacts">
       				</div>
       				<div class="contacts_container_item_top">
       					<p>Email: </p>
       				</div>
       				<div class="contacts_container_item_bottom">
       					<p><a href="mailto:<?= $settings->email ?>"><?= $settings->email ?></a></p>
       				</div>
       			</div>
       			<div class="contacts_container_item">
       				<div class="contacts_container_item_image">
       					<img src="<?= $this->Url->build('/img/phone_contacts.svg', ['fullBase' => true]) ?>" alt="Contacts">
       				</div>
       				<div class="contacts_container_item_top">
       					<p>Телефонуйте: </p>
       				</div>
       				<div class="contacts_container_item_bottom">
       					<p><?= $settings->phones ?></p>
       				</div>
       			</div>
       		</div>
       		<form action="" class="main_contact_form">
       		<div class="contacts_container_inside">
       			<div class="contacts_container_inside_item contacts_container_inside_item_left">
       				<div class="contacts_container_inputs">
       					<input type="text" name="user_name" placeholder="Ім'я" required="required">
       				</div>
       				<div class="contacts_container_inputs">
       					<input type="email" name="user_email" placeholder="Email" required="required">
       				</div>
       			</div>
       			<div class="contacts_container_inside_item contacts_container_inside_item_right">
       				<textarea name="user_message" id="" placeholder="Повідомлення" required="required"></textarea>
       			</div>
       		</div>
       		<div class="contacts_container_bottom">
       			<input type="submit" value="Надіслати">
       		</div>
          <div class="contacts_sented_message">
            <p>Ваше повідомлення надіслано.</p>
          </div>
       		</form>
       	</div>
       	<div id="contact_form_leftt" ></div>

       </div>
	</div>
</section>


<script>




            function initMap() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 14,

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(<?= $settings->adress_lat ?>, <?= $settings->adress_lng ?>), // Домажир

                    // How you would like to style the map.
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#f3f4f4"
            },
            {
                "saturation": -84
            },
            {
                "lightness": 59
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "labels",
        "stylers": [
            {
                "hue": "#ffffff"
            },
            {
                "saturation": -100
            },
            {
                "lightness": 100
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#83cead"
            },
            {
                "saturation": 1
            },
            {
                "lightness": -15
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.school",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#d7e4e4"
            },
            {
                "saturation": -60
            },
            {
                "lightness": 23
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#ffffff"
            },
            {
                "saturation": -100
            },
            {
                "lightness": 100
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
            {
                "hue": "#bbbbbb"
            },
            {
                "saturation": -100
            },
            {
                "lightness": 26
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#ffcc00"
            },
            {
                "saturation": 100
            },
            {
                "lightness": -22
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#ffcc00"
            },
            {
                "saturation": 100
            },
            {
                "lightness": -35
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#7fc8ed"
            },
            {
                "saturation": 55
            },
            {
                "lightness": -6
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [
            {
                "hue": "#7fc8ed"
            },
            {
                "saturation": 55
            },
            {
                "lightness": -6
            },
            {
                "visibility": "off"
            }
        ]
    }
]


                };

                // Get the HTML DOM element that will contain your map
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('contact_form_leftt');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);


                // Let's also add a marker while we're at it
                 var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(<?= $settings->adress_lat ?>, <?= $settings->adress_lng ?>),
                    map: map,
                });
                 google.maps.event.addDomListener(window, 'load', initMap);
            }

  
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHERUACFYImGjljgQMWO6Gu3KzROlIpOo&language=uk&callback=initMap"></script>

<script>
      <?php echo $this->Html->scriptStart(['block' => true]); ?>

  $(".main_contact_form").submit(function() {
event.preventDefault(); 
$.ajax({
        url: '<?= $this->Url->build(['controller' => 'contacts', 'action' => 'add', '_full' => true]) ?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){  
          $(".contacts_container_inside input").val("");
          $(".contacts_container_inside textarea").val("");
          $(".contacts_sented_message ").css('display', 'block');
        }
                   
     });
  });
    <?php echo $this->Html->scriptEnd(); ?>

 </script>