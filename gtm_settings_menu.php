<div id="mokusiga_admin_menu">
<h2>Google Tag Manager - Mokusiga</h2>
<noscript>
<div class="message"><p>Please enable Javascript for a more interactive form.</p></div>
</noscript>
<?php if($this->updated) {
  echo '<div class="message"><p>Google Tag Manager Settings saved succesfully</p></div>';
}

if(0 < strlen($this->custom_message)){
  echo '<div class="message"><p>'.$this->custom_message.'</p></div>';
}

$helpImgSrc =  plugins_url( 'images/gnome_dialog_question_16.png' , __FILE__ );
?>



<form method="post" action="" id="mksg_form">
    <div>
        <h3>Basic:</h3>
        <label for="mksg_gtm_id">Container ID<span class="red"> *:</span></label> <br />
        <input type="text" id="mksg_gtm_id" 
            name="mksg_gtm_id" placeholder="GTM-ABCD" 
            value="<?php echo $this->gtm_id; ?>" required /> 
            <a class="help" href="http://mokusiga.com/wordpress/google-tag-manager/#gtm_container_id" 
                title="Container ID" target="_blank">
                <img src="<?php echo $helpImgSrc; ?>" alt="help" />
            </a>
    </div>
    <div>
        <h3>Advanced:</h3>
        <label>Location of script<span class="red"> *</span>:</label> 
            <a class="help" href="http://mokusiga.com/wordpress/google-tag-manager/#gtm_location" 
                title="Where to Place GTM code?" target="_blank">
                <img src="<?php echo $helpImgSrc; ?>" alt="help" />
            </a><br />
        <input type = 'radio' name ='mksg_location' 
            id='mksg_location_footer' value= 'wp_footer'
            onclick="mksg_gtm.showHideDatalayerLocation();"
            <?php if('wp_footer' == $this->gtm_location) echo 'checked'; ?> 
            />
        <label for="mksg_location_footer">footer</label>  &nbsp;&nbsp;&nbsp;&nbsp;
        <input type = 'radio' name ='mksg_location' 
            id='mksg_location_custom' value= 'custom' 
            onclick="mksg_gtm.showHideDatalayerLocation();"
            <?php if('wp_footer' != $this->gtm_location) echo 'checked'; ?>
            /> 
        <label for="mksg_location_custom">custom</label>
        <div id="mksg_location_custom_div">
            <input type="text" id="mksg_location_custom_text" 
            name="mksg_location_custom_text" 
            placeholder="custom hook name in template" 
            value="<?php echo $this->gtm_location_text; ?>" />
            <a class="help" href="http://mokusiga.com/wordpress/google-tag-manager/#gtm_location_custom" 
                title="What is a custom hook?" target="_blank">
                <img src="<?php echo $helpImgSrc; ?>" alt="help" />
            </a>
        </div>
        <div style="">&nbsp;</div>
        <label for="mksg_datalayer_name">DataLayer Name <?php echo $this->gtm_datalayer_name; ?><span class="red"> *</span>:</label><br />
        <input type="text" id="mksg_datalayer_name" 
            name="mksg_datalayer_name" 
            placeholder="dataLayer" 
            value="<?php echo $this->gtm_datalayer_name; ?>" required /> 
            <a class="help" href="http://mokusiga.com/wordpress/google-tag-manager/#gtm_datalayer_name" 
                title="Renaming DataLayer" target="_blank"><img src="<?php echo $helpImgSrc; ?>" alt="help" />
            </a><br />
             
        <div class="indentLeft" id="mksg_datalayer_options" style="">
            <strong>Manually set other dataLayer variables</strong>
                <a class="help" href="http://mokusiga.com/wordpress/google-tag-manager/#gtm_using_datalayer" 
                        title="Using dataLayer" target="_blank">
                        <img src="<?php echo $helpImgSrc; ?>" alt="help" />
                    </a>     <br />
            <ul>
                <li>
                    <label for="mksg_datalayer_isLoggedIn">Insert variable for logged in users?</label>
                    <input type="checkbox" id="mksg_datalayer_isLoggedIn" 
                        name="mksg_datalayer_isLoggedIn" <?php echo $this->gtm_datalayer_show_users; ?> 
                        onclick="mksg_gtm.checkDatalayerLoggedUser();"
                        /> 
                    <a class="help" href="http://mokusiga.com/wordpress/google-tag-manager/#gtm_datalayer_loggedin" 
                        title="Option to set Logged In Users" target="_blank">
                        <img src="<?php echo $helpImgSrc; ?>" alt="help" />
                    </a>
                </li>
                <li>
                    <label for="mksg_datalayer_wp_version">Insert variable for WordPress Version?</label>
                    <input type="checkbox" id="mksg_datalayer_wp_version" 
                        name="mksg_datalayer_wp_version" <?php echo $this->gtm_datalayer_show_wp_version; ?> 
                        onclick="mksg_gtm.checkDatalayerLoggedUser();"
                        /> 
                    <a class="help" href="http://mokusiga.com/wordpress/google-tag-manager/#gtm_datalayer_wp_version" 
                        title="Option to set WordPress Version" target="_blank">
                        <img src="<?php echo $helpImgSrc; ?>" alt="help" />
                    </a>
                </li>
                
                
                
                
                
               <li>
                    <label for="mksg_datalayer_text">Other Custom dataLayer variables:</label>
                    <a class="help" href="http://mokusiga.com/wordpress/google-tag-manager/#gtm_datalayer_custom" 
                        title="Additional Custom Datalayer variables" target="_blank">
                        <img src="<?php echo $helpImgSrc; ?>" alt="help" />
                    </a>                      
                    <br />
                    
                    
                    <textarea id="mksg_datalayer_text" name="mksg_datalayer_text"
                            class=""><?php echo $this->gtm_datalayer_text; ?></textarea><br />
                
        </div>    
            
    </div>

    <input type="submit" class="submit" 
        id="mksg_submit" name="mksg_submit" value="Save Settings" />
    <div style="clear:both;height:1px;">&nbsp;</div>
</form>
<div class="" id="mksg_sample"><div>
<h3>Sample of Generated Code:</h3>
<pre class="code" style="">
&lt;!-- Google Tag Manager --&gt;
&lt;script&gt;
<strong id="mksg_datalayer_name_text1"><?php echo $this->gtm_datalayer_name; ?></strong> = [{
<div class="code indentLeft noBMP" id="mksg_show_users_code"></div>}];
&lt;/script&gt;
&lt;noscript&gt;&lt;iframe src="//www.googletagmanager.com/ns.html?id=<strong id="mksg_gtm_id_text1"><?php echo $this->gtm_id; ?></strong>"
height="0" width="0" style="display:none;visibility:hidden"&gt;&lt;/iframe&gt;&lt;/noscript&gt;
&lt;script&gt;(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&amp;l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','<strong id="mksg_datalayer_name_text2"><?php echo $this->gtm_datalayer_name; ?></strong>','<strong id="mksg_gtm_id_text2"><?php echo $this->gtm_id; ?></strong>');&lt;/script&gt;
&lt;!-- End Google Tag Manager --&gt;
<br />
</pre>
<br />
<p>What do you think of this plugin? <a href="http://wordpress.org/support/view/plugin-reviews/mokusiga-google-tag-manager" title="Review">Review it!</a>
</p>
</div>

<script type="text/javascript">
/* <![CDATA[ */
var mksg_gtm = {
    init:function(){
        this.checkDatalayerLoggedUser();
        this.resetWidth();
        this.gtmDatalayerTextChange();
        
        var gtm_id = document.getElementById('mksg_gtm_id');
        if (gtm_id.addEventListener) {
            gtm_id.addEventListener('input', function() {
                mksg_gtm.gtmIdChange();
            }, false);
        } else if (gtm_id.attachEvent) {
            gtm_id.attachEvent('onpropertychange', function() {
                mksg_gtm.gtmIdChange();
            });
        }
        
        var datalayer_name = document.getElementById('mksg_datalayer_name');
        if (datalayer_name.addEventListener) {
            datalayer_name.addEventListener('input', function() {
                mksg_gtm.gtmDatalayerNameChange();
            }, false);
        } else if (datalayer_name.attachEvent) {
            datalayer_name.attachEvent('onpropertychange', function() {
                mksg_gtm.gtmDatalayerNameChange();
            });
        }
        
        this.showHideDatalayerLocation();
    },
    showHideDatalayerLocation:function(){
        if(document.getElementById('mksg_location_custom').checked) {
            document.getElementById('mksg_location_custom_div').style.display = 'block';
        }else{
            document.getElementById('mksg_location_custom_div').style.display = 'none';
        }
    },
    resetWidth:function(){
        var main = document.getElementById('mokusiga_admin_menu'),
        form = document.getElementById('mksg_form'),
        sample = document.getElementById('mksg_sample');
        var main_width = main.offsetWidth,
        form_width = form.offsetWidth,
        sample_width = sample.offsetWidth,
        form_height = form.offsetHeight,
        sample_height = sample.offsetHeight;
        if(main_width>620){
            sample_width = main_width - form_width - 40;
            sample.style.width = sample_width+"px";
        }

    },
    gtmIdChange:function(){
        
        var val = document.getElementById('mksg_gtm_id').value;
        document.getElementById('mksg_gtm_id_text1').innerHTML = val;
        document.getElementById('mksg_gtm_id_text2').innerHTML = val;
    },
    gtmDatalayerTextChange:function(){
        var area = document.getElementById('mksg_datalayer_text');
        if (area.addEventListener) {
            area.addEventListener('input', function() {
                mksg_gtm.checkDatalayerLoggedUser();
            }, false);
        } else if (area.attachEvent) {
            area.attachEvent('onpropertychange', function() {
                mksg_gtm.checkDatalayerLoggedUser();
            });
        }
    },
    gtmDatalayerNameChange:function(){
        var val = document.getElementById('mksg_datalayer_name').value;
        document.getElementById('mksg_datalayer_name_text2').innerHTML = val;
        document.getElementById('mksg_datalayer_name_text1').innerHTML = val;
    },
    checkDatalayerLoggedUser:function(){
        
        var mksg_datalayer_isLoggedIn = document.getElementById('mksg_datalayer_isLoggedIn'),
        mksg_datalayer_wp_version = document.getElementById('mksg_datalayer_wp_version'),
        mksg_show_users_code = document.getElementById('mksg_show_users_code'), 
        mksg_text = '', otherDatalayer = document.getElementById('mksg_datalayer_text').value;
        mksg_text = (mksg_datalayer_isLoggedIn.checked) ? "'isLoggedIn' : 'true'" : '';
              
        if(mksg_datalayer_wp_version.checked){
        	if(mksg_text.length > 0){
        		mksg_text = mksg_text + ",\n'wpVersion' : '<?php echo $wp_version; ?>'";	
        	}else{
        		mksg_text = mksg_text + "'wpVersion' : '<?php echo $wp_version; ?>'";	
        	}
        }
        
        inner = '';
        otherDatalayer = otherDatalayer;
        if(mksg_text.length > 0 && otherDatalayer.length > 0){
            inner = mksg_text+",\n"+otherDatalayer+"";    
        }
        else if(mksg_text.length > 0 && otherDatalayer.length == 0){
            inner = mksg_text;    
        }else{
            inner = otherDatalayer;
        }
        mksg_show_users_code.innerHTML = '<strong>'+inner+'</strong>';  
        /*
        if (mksg_datalayer_isLoggedIn.checked){
            mksg_show_users_code.style.display="inline";      
        } else{
            mksg_show_users_code.style.display="none";
        }
        mksg_show_users_code.style.marginLeft="20px";  */
    }
};
mksg_gtm.init();
/* ]]> */
</script>

</div>   <!-- End div.mokusiga_admin_menu -->