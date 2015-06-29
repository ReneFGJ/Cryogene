echo off
echo **************************************
echo * Install sisdoc From ****************
echo * Version 0.15.27 ********************
echo * Author Rene F. Gabriel Junior ******
echo **************************************
d:
cd \projeto\cryogene\cryoi
copy ..\..\_include\codeigniter\form_sisdoc_helper.php application\helpers\*
mkdir css
copy ..\..\_include\codeigniter\style_form.css css\*

echo Arquivos transferidos
echo this - load - helper('form_sisdoc');
echo this - load - helper('url');
echo this - load - library('session');
echo this - lang - load("app", "portuguese");
pause
