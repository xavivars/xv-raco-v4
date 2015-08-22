<?php
    if(!$xaviutils && !isset($_GET['debug']))
      die('No es pot incloure directament');
?><script src="/js/toolkit.js" type="text/javascript"></script>
<script src="/js/numbers.js" type="text/javascript"></script>
<script type="text/javascript">
    
    function convert() {
        
        var inp = $('romans_in').value;
        var out = Numbers.convert(inp);
        
        if(out!=false)
            $('romans_out').innerHTML = inp + ' &hArr; ' + out;
        else
            $('romans_out').innerHTML = 'ERROR. Entrada invàlida ('+inp+')';
        
        return false;
    }
    
</script>
<div style="width:100%;text-align:center;margin-top:10px;margin-bottom:10px;">
    <div style="padding:20px;border:1px solid #ccc;width:60%;margin-left:auto;margin-right:auto;font-size:1.1em;">
        <div style="font-variant:small-caps;padding-bottom:10px;text-decoration:underline;">Conversor de nombres romans</div>
    <form action="/utils/numeros-romans/" method="post" onsubmit="return convert();">
      <input type="text" name="romans_in" id="romans_in" 	/>
      <input type="submit" value="&crarr;" />
    </form>
    <div id="romans_out" style="padding-top:10px;color:white;font-weight:bold;"></div>
    </div>
</div>
<?php
    
?>
