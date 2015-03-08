@echo off&@shift
Title 同级文件名字替换修改工具 
mode con cols=43 lines=13
color 0b
cls
goto menu
:menu
cls
echo -------------------------------------------
echo    本工具仅供技术交流使用  
echo    作者qq29486594 風鏇碧浪  
echo    并由qq394410571 寂樱   修改加强人性化
echo    %date%  %time%
echo -------------------------------------------
echo 使用方法：
echo   1.填写你要替换或者去掉的文件名的字符串
echo   2.填写你要替换成的字符串
echo   3.填写你要替换的后缀(文件类型)
set /p thname=请填写第1步:
set /p thcname=请填写第2步:
set /p hzname=请填写第3步:
goto zx
:zx
setlocal enabledelayedexpansion
for /f "delims=" %%1 in ('dir /a /b *.%hzname%') do (set wind=%%1
ren "%%~1" "!wind:%thname%=%thcname%!")
pause
goto menu