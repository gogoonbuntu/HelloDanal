<link rel="stylesheet" href="../css/invite.css">
<div id="loading" class="hide">
    <img src="../img/danaly run.gif">
    <div id="loading_text">Loading...</div>
</div>
<style>
    #loading {
        text-align:center; 
        position:fixed; 
        width:100%; 
        height:100%; 
        top:0;
        left:0;
        background:rgb(0,0,0,0.7);
        z-index:100;
    }
    #loading>img {
        top: 50%;
        margin-top: -150px;
        position: relative;
    }
    #loading_text {
        color:#fff;
        font-size:30px;
    }
</style>
<script>
    function goLoading() {
        document.querySelector("#loading").classList.remove('hide') ;
        var loading_text = document.querySelector("#loading_text") ;
    
        loading_text.innerHTML="loading." ;
        setTimeout( function () {loading_text.innerHTML="loading.." ;}, 1000) ;
        setTimeout( function () {loading_text.innerHTML="loading..." ;}, 2000)
        
        var loading_interval = setInterval( function () {
            loading_text.innerHTML="loading." ;
            setTimeout( function () {loading_text.innerHTML="loading.." ;}, 1000) ;
            setTimeout( function () {loading_text.innerHTML="loading..." ;}, 2000)
        }, 3000) ;
    }
</script>