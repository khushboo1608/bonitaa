<style>
.justify{text-align: justify;}
.bold{font-weight: bold;}
.underline{text-decoration: underline;}

.half__red{
	background: #ff0054; padding: 0px 10px;
}

/*Margin */
.MB__8px{margin-bottom: 8px;}

/*Fonts */
.font-12{font-size: 12px;}	
.font-13{font-size: 13px;}
.font-14{font-size: 14px;}
.font-15{font-size: 15px;}
.font-16{font-size: 16px;}
.font-17{font-size: 17px;}
.font-18{font-size: 18px;}
.font-19{font-size: 19px;}
.font-20{font-size: 20px;}
.font-22{font-size: 22px;}
.font-25{font-size: 25px;}


/* cart button  */
#addtocart-button {
    background: none;
    border: medium none;
    padding: 1px 0px;
    position: absolute;
    right: -23px;
    top: 24px;
    cursor: pointer;
}
#addtocart-button i {
    color: #000;
    font-size: 23px;
}

.product-category {
    padding: 50px 0 100px;
}

@media (max-width: 991px){
    #addtocart-button {
	    right: 40px;
	    top: 14px;
	}
    .mob-cat{
        width: 33%;
    }
    .mob-cat img{
        border-radius: 50%;
        height: 50%!important;
    }

    .deals_cat1{
        width: 50%;
        border: 1px solid #ddd2d2;
    }
    .deals_cat1 img{
        border-radius: 50%;
        height: 50%!important;
    }
    .static_deals img{
        height: 135px!important;
        /* margin-left: -8px!important; */
    }
    .section-title {
        margin-bottom: 1rem;
    }
    .single-service img{
        height: 105px!important;
    }

    /* Hide Scroller Button from Mobile View */
    .swiper-button-next, .swiper-button-prev{
        display: none;
    }
    .plogo{padding: 6px!important;}

    /*one time used product logo Mobile View */
    .onetime-use{margin-bottom: 20px;}

    #cat__sub__heading{ background: #F2184F; color:#fff;padding: 4px 10px; font-size: 20px;}

    /* #slider-category img{} */

    .subcat-image{
        background: #fff;
        padding: 20px;
    }

    #logged-user-name{
        margin: 6px 6px!important;
        padding: 9px 10px!important;
        text-align: left;
    }

    .offer-banner-div{
        border-bottom: 1px solid #f36e20;
        margin: 2px 4px;
        padding: 4px 4px;
    }

    #locationbtn {
	    right: 100px!important;
	    top: 15px!important;
	}
}

/* Mobiel View FInsiehed */
.static_deals img{
    border-radius: 20px; 
    height: 225px;  
    padding:5px;
    border: 1px solid;
}

.subcat-image{
    border-radius: 50%;
}

.service-section .cat-service:hover img{
    transform: scale(1.04);  
}

/*Our 1time brand pack use */
.service-section .onetime-use:hover img{
    transform: scale(1.02);    
}

/* Modern Scoll bar */
::-webkit-scrollbar { width: 7px; height: 4px;} 
.webkit-scrollbar-button {  background-color: #999; border-radius: 10px; }
::-webkit-scrollbar-track {  background-color: #F8F8F8;}
::-webkit-scrollbar-track-piece { background-color: #F8F8F8;}
::-webkit-scrollbar-thumb { height: 50px; background-color: #23272b; border-radius: 10px;}
::-webkit-scrollbar-corner { background-color: #F8F8F8;}
::-webkit-resizer { background-color: #999;}

 /*one time used product logo */
.plogo{
    height: 120px; width: 120px;border-radius: 50%; background: #fff;/* border: 5px dotted #d5275a;*/ padding: 15px;
}

#cat__sub__heading{
    background: #000; color:#fff;padding: 4px 10px;border-radius: 15px 5px;
}

#highlight__bg__black{background: #000; color:#fff;padding: 4px 11px;}
#highlight__bg__outer{ border: 3px solid #000; padding: 4px 0px 4px 12px;}

#highlight__offer__day{background: #af398f; color:#fff;padding: 4px 11px;}
#highlight__offer__outer{border: 3px solid #af398f; padding: 4px 0px 4px 12px;}

/* WhatsApp Floating Icon CSS */
.whatsapp_float{ position: fixed; bottom: 30px; left: 20px;z-index: 9999; display: none;}
.whatsapp_float_btn{ border-radius: 50%;}

/* WhatsApp Floating Icon CSS */
.cart_float{ position: fixed; bottom: 30px; left: 20px;z-index: 9999; display: block;}
/*.cart_float_btn{ border-radius: 50%;}*/


/* Feedback Icon CSS */
.feedback_float{ position: fixed; bottom: 8px; right: 5px ;z-index: 9999;}
.feedback_float_btn{width:auto; background-color:#af398f; color:#fff;}

/* Cart Class  */
.cart_class{
    top: -.9em;
    font-size: 11px;
    background: #000;
    border-radius: 50%;
    padding: 5px;
    color: white;
}
.cart_qty{
    /*width: 50px;
    padding: 0px 0px 0px 6px!important;
    margin: 0px!important;*/
    line-height: 30px!important;
    height: 32px;
}

.checkout-remove{
    background: tomato;
    color: #fff!important;
    padding: 0px 5px;
    border-radius: 50%;
    margin: 2px 18px;
}

@media (max-width: 991px){
    .beauty-header {
        padding: 0px 0!important;
    }
}


/* Popup CSS :: START  */
.w3-btn,.w3-button{border:none;display:inline-block;outline:0;padding:8px 16px;vertical-align:middle;overflow:hidden;text-decoration:none;color:inherit;background-color:inherit;text-align:center;cursor:pointer;white-space:nowrap}
.w3-display-topright{position:absolute;right:0;top:0}
.w3-modal-content{margin:auto; background:none;position:relative;padding:0;outline:0;width:90%; max-width:500px;}
.w3-modal{z-index:99999;display:block;padding-top:60px;position:fixed;left:0;top:0;width:100%;height:100%;overflow:auto; background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.8)}
.greyscale{cursor:pointer;}
.greyscale:hover{ -webkit-filter: grayscale(100%);  /* Safari 6.0 - 9.0 */
  filter: grayscale(100%); }  
/* Popup CSS :: END  */


/*
background hide
background-color: rgba(0,0,0,0.89);
*/

.city_available li{
    margin: 0px 2px 10px 6px;
    border: 1px solid white;
    border-radius: 20px;
    color: #fff;
    padding: 0px 10px;
}

.location_submit_button{
    border: none;
    background: #00a65a !important;
    color: white;
    padding: 0px 7px;
    margin-top: 4px;
    border-radius: 7px;
    font-size: 12px;
    cursor: pointer;
}

#featured_videos{
    border:1px solid grey; 
    padding:10px; 
    border-radius:10px;
}

.mh100{
    min-height: 100px!important;
}
#service ul{
    list-style: disc;
    margin: 0px 16px;
}
#service_profileimg{
    width: 110px;
    border: 1px solid gainsboro;
    padding: 4px;
    border-radius: 50%;
}

.beauty-header .custom-logo {
    margin: 2px 0px 0 0!important;
}

.top-margin {
    margin-top: 0px!important;
}

#locationbtn {
    padding: 2px 6px;
    position: absolute;
    /* right: -23px; */
    top: 24px;
    font-weight: bold;
    cursor: pointer;
}
#locationbtn i {
    color: red;
    font-size: 23px;
}

/* Graident Colors */
.gradient_1{
    background: linear-gradient(173deg, rgb(255, 166, 0), rgb(255, 0, 128));
}
.gradient_2{
    /* background: linear-gradient(173deg, rgb(249, 113, 167), rgb(255, 200, 0)); */
    /* background: linear-gradient(135deg, rgb(243, 110, 32), rgb(174, 57, 149)); */
    background: linear-gradient(135deg, rgb(238, 106, 44), rgb(182, 62, 136));
}
.boreder_radius_25px_top{
    border-radius: 25px 25px 0px 0px!important;
}
.border_radius_25px{
    border-radius: 25px
}

.box_shadow1{
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}

/* WhatsApp Floating Icon CSS */
.playstore_float{ position: fixed; bottom: 30px; left: 20px;z-index: 9999;background: #fff;
    border-radius: 50%;}
.playstore_float_btn{ border-radius: 50%;}
</style>