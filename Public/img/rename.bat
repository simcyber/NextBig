@echo off&@shift
Title ͬ���ļ������滻�޸Ĺ��� 
mode con cols=43 lines=13
color 0b
cls
goto menu
:menu
cls
echo -------------------------------------------
echo    �����߽�����������ʹ��  
echo    ����qq29486594 �L曱���  
echo    ����qq394410571 ��ӣ   �޸ļ�ǿ���Ի�
echo    %date%  %time%
echo -------------------------------------------
echo ʹ�÷�����
echo   1.��д��Ҫ�滻����ȥ�����ļ������ַ���
echo   2.��д��Ҫ�滻�ɵ��ַ���
echo   3.��д��Ҫ�滻�ĺ�׺(�ļ�����)
set /p thname=����д��1��:
set /p thcname=����д��2��:
set /p hzname=����д��3��:
goto zx
:zx
setlocal enabledelayedexpansion
for /f "delims=" %%1 in ('dir /a /b *.%hzname%') do (set wind=%%1
ren "%%~1" "!wind:%thname%=%thcname%!")
pause
goto menu