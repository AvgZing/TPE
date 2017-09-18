@echo off
TITLE TurbineMC server for Minecraft: Bedrock Edition
cd /d %~dp0

if exist bin\php\php.exe (
	set PHPRC=""
	set PHP_BINARY=bin\php\php.exe
) else (
	set PHP_BINARY=php
)

if exist TurbineMC*.phar (
	set POCKETMINE_FILE=TurbineMC*.phar
) else (
	if exist PocketMine-MP.phar (
		set POCKETMINE_FILE=PocketMine-MP.phar
	) else (
	    if exist src\pocketmine\PocketMine.php (
	        set POCKETMINE_FILE=src\pocketmine\PocketMine.php
		) else (
			if exist TurbineMC.phar (
				set POCKETMINE_FILE=TurbineMC.phar
			) else (
		        echo "[ERROR] Couldn't find a valid TurbineMC version."
		        pause
		        exit 8
		    )
	      )
	)
)

if exist bin\mintty.exe (
	start "" bin\mintty.exe -o Columns=88 -o Rows=32 -o AllowBlinking=0 -o FontQuality=3 -o Font="DejaVu Sans Mono" -o FontHeight=10 -o CursorType=0 -o CursorBlinks=1 -h error -t "TurbineMC" -i bin/Turbine.ico -w max %PHP_BINARY% %POCKETMINE_FILE% --enable-ansi %*
) else (
	%PHP_BINARY% -c bin\php %POCKETMINE_FILE% %*
)
echo "  +------------------------------------------------------------+"
echo "  |      _______         _     _            __  __  _____      |"
echo "  |     |__   __|       | |   (_)          |  \/  |/ ____|     |"
echo "  |        | |_   _ _ __| |__  _ _ __   ___| \  / | |          |"
echo "  |        | | | | | '__| '_ \| | '_ \ / _ \ |\/| | |          |"
echo "  |        | | |_| | |  | |_) | | | | |  __/ |  | | |____      |"
echo "  |        |_|\__,_|_|  |_.__/|_|_| |_|\___|_|  |_|\_____|     |"
echo "  +------------------------------------------------------------+"
