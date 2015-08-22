<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>TODO supply a title</title>
        <script src="/js/ajaxlib.js" type="text/javascript"></script>
    </head>
    <body>
        <script type="text/javascript">
            function prova(resp) {
                document.getElementById('translation').innerHTML = resp;
            }
            
            function apertium() {
                
                var ajx = new AJAXLib('json');
                var markvalue = (document.getElementById('mark').checked)?1:0;
                if(document.getElementById('url').value=='apertium.org') {
                
                    ajx.get('http://apertium.org/common/tt.php',{'dir':document.getElementById('dir').value,'text':document.getElementById('text').value,'mark':markvalue},'prova');
                } else  {
                    ajx.get('http://xixona.dlsi.ua.es/webservice/ws.php',{'mode':document.getElementById('dir').value,'text':document.getElementById('text').value,'mark':markvalue},'prova');
                }
                
                
                return false;
            }
          
          
        </script>
        <form onsubmit="return apertium()">
            Language: <select id="dir" name="dir">
            <option value="es-ca">ES-CA</option>
                        <option value="ca-es">CA-ES</option>
            </select><br />
            URL: <select name="url" id="url">
            <option value="apertium.org">APERTIUM.ORG</option>
            <option value="xixona">XIXONA</option>
            </select><br />
            Text:<br /><textarea style="width:50%" rows="10" id="text" name="text"></textarea><br/>
            Mark unknown words: <input type="checkbox" name="mark" id="mark" /><br />
            <input type="submit" value="translate" />
        </form><br /><br />
        TRANSLATION: 
        <div id="translation" 
          style="width:50%;min-height:100px;border:1px dotted gray;background:#ccfccf">
        </div>
    </body>
</html>
