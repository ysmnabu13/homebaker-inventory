<x-layout>
    <style>
        .slider-frame{
            overflow: hidden;
            height: 800px;
            width: 1200px;
            margin-left: 175px;
        }

        @-webkit-keyframes slide_animation{
            0% {left:0px;}
            10% {left:0px;}
            20% {left:1200px;}
            30% {left:1200px;}
            40% {left:2400px;}
            50% {left:2400px;}
            60% {left:1200px;}
            70% {left:1200px;}
            80% {left:0px;}
            90% {left:0px;}
            100% {left:0px;}
        }

        .slide-images{
            width: 3600px;
            height: 800px;
            margin: 0 0 0 -2400px;
            position: relative;
            -webkit-animation-name: slide_animation;
            -webkit-animation-duration: 33s;
            -webkit-animation-iteration-count: infinite;
            -webkit-animation-direction: alternate;
            -webkit-animation-play-state: running;
        }

        .img-container{
            margin-top: 5px;
            height: 800px;
            width: 1200px;
            position: relative;
            float: left;
        }
    </style>
    <!-- sliding images -->
    <div class="slider-frame">
        <div class="slide-images">
            <div class="img-container">
            <img src="images/image1.png">
            </div>
            <div class="img-container">
            <img src="images/image2.png">
            </div>
            <div class="img-container">
            <img src="images/image3.png">
            </div>
        </div>
    </div>
</x-layout>