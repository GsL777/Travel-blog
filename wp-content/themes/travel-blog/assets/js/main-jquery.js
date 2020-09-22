jQuery(document).ready(function($){



	$(document).ready(function() {
		$('#show-hidden-menu').click(function() {
			$('.hidden-menu').slideToggle("slow");
		// Alternative animation for example
		// slideToggle("fast");
		});
	});


    /* AJAX LOAD MORE START ajax.php, index.php, index.scss*/
    $(document).on('click','.travel-load-more:not(.loading)', function(){//$(document).on('click' - action is activated when travel-load-more doesn't have .loading class applied to it

        var that = $(this); //inside that will be stored .travel-load-more or whatever button is clicked
        var page = $(this).data('page'); //page - is a name of a data-PAGE in index.php in Load More container.
        var newPage = page + 1;
        var ajaxurl = that.data('url'); //url in index.php data-(name), data url.
        var archive = that.data('archive');//for archive page archive.php

        //archive page START
        if( typeof archive === 'undefined' ){//The typeof operator when applied to the jQuery object returns the string "function". Basically that does mean that jQuery is a function.
            archive = 0;
        }
        //archive page END

        //IN JQUERY IF YOU ADD OR REMOVE THE CLASSES DO NOT HAVE TO REMOVE THE DOT (.)
        //IF YOU ARE SEARCHING FOR A CLASS YOU HAVE TO PUT A DOT (.).
        that.addClass('loading').find('.text').slideUp(320);
        that.find('.travel-icon').addClass('spin');

        $.ajax({
            url : ajaxurl,
            type : 'post',// post - the same type that it is seen in a <form> and the post methot in ajax is a default type.
            //$_POST (post method) - is a method that passes all the variables hidden inside the reload of the page. These methods are not getting printed anywhere.
            //$_GET (get method) - print the variables inside the url so you will see the variables inside the url. GET method is not safe
            data : {// data contains all the custom data like the array and we can write in the {} and send to the ajax function
                page : page, //First variable - page is the name of the variable
                archive : archive, //Archive variable 
                action: 'travel_load_more' //Second variable - action. We are sending a data to a php file and the php file in order to be properly triggered needs an action: to trigger a specific function. So action needs to be identical to the function that we whant to call.
                //travel_load_more - function name in ajax.php
            },
            error : function( response ){
                console.log(response);
            },
            success : function( response ){

            if( response == 0 ){//means that we do not have any posts to load
                
                $('.travel-posts-container').append( '<div class="text-center"><h3>You reached the end of the line!</h3><p>No more posts to load.</p></div>' );
                    
                    that.slideUp(320);

                } else {

                    setTimeout(function(){

                        that.data('page', newPage); //newPage -  data page will be updated dynamically by increment +1.
                        $('.travel-posts-container').append( response );

                        that.removeClass('loading').find('.text').slideDown(320); //$(this) is changed with variable that.
                        that.find('.travel-icon').removeClass('spin');

                        //revealPosts();/*reaveal post in index.scss*/

                    }, 1000);

                }
            }
        });

    });
    /* AJAX LOAD MORE END */


   /*Contact form submission START*/ //contact-form.php
    //FILES INCLUDE shortcodes.php, function.php(to add ajax.php), contact-form.php, ajax.php, theme-support.php, custom-post-type.php, contact.scss
    $('#ContactForm').on('submit', function(e){//e - means element
        e.preventDefault();//avoid the form when submitting to href to whatever location that is not wanted

       // console.log('Form submitted');//test to check if it works

        $('.has-error').removeClass('has-error');//remove has-error class when input is filled and submitted
        $('.js-form-submission').removeClass('js-form-submission');

        var form = $(this), //$(this) - stands for the parent element in jQuery function (in this case #DesignContactForm)
            name = form.find('#name').val(), //name - the id in the contact-form.php
            email = form.find('#email').val(),
            message = form.find('#message').val(),
            ajaxurl = form.data('url'); //data url must be defined in contact-form.php

            if( name === '' ){
                //console.log('Required inputs are empty');
                $('#name').parent('.form-group').addClass('has-error');//#name - id in contact-form.php
                
                return;//return stops the execution of the script at this point. 
                //It is not going to go on the second line and not going to continue if this if statement is true.
            }

            if( email === '' ){
                $('#email').parent('.form-group').addClass('has-error');//#email - id in contact-form.php
                
                return;
            }

            if( message === '' ){
                $('#message').parent('.form-group').addClass('has-error');//#message - id in contact-form.php
                
                return;
            }

            form.find('input, button, textarea').attr('disabled', 'disabled');//disables input, button, textarea. form - var form = $(this).
            $('.js-form-submission').addClass('js-show-feedback');//class from contact-form.php appears after submit button is pushed

        //console.log(form);
        //console.log(name);

        $.ajax({
            url : ajaxurl,
            type : 'post',// post - the same type that it is seen in a <form> and the post method in ajax is a default type.
            //$_POST (post method) - is a method that passes all the variables hidden inside the reload of the page. These methods are not getting printed anywhere.
            //$_GET (get method) - print the variables inside the url so you will see the variables inside the url. GET method is not safe
            data : { // data contains all the custom data like the array and we can write in the curly brackets and send to the ajax function
 
                name : name,
                email : email,
                message : message,
                action: 'travel_save_user_contact_form' //function travel_save_contact in ajax.php 

            },
            error : function( response ){
                $('.js-form-submission').removeClass('js-form-feedback');
                $('.js-form-error').addClass('js-show-feedback');
                form.find('input, button, textarea').removeAttr('disabled');
            },
            success : function( response ){
                if( response == 0 ){

                    setTimeout(function(){
                        //console.log('Unable to save your message, Please try again later');
                        $('.js-form-submission').removeClass('js-form-feedback');
                        $('.js-form-error').addClass('js-show-feedback');
                        form.find('input, button, textarea').removeAttr('disabled');
                    }, 1500);
                } else {

                    setTimeout(function(){
                        //console.log('Message saved!');
                        $('.js-form-submission').removeClass('js-form-feedback');
                        $('.js-form-success').addClass('js-show-feedback');
                        form.find('input, button, textarea').removeAttr('disabled').val('');
                    }, 1500);
                }
            }
        });
    });
    /*Contact form submission END*/



});