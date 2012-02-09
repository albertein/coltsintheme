BASEPATH=c:\\xampp\\htdocs\\wp\\wp-content\\themes\\coltsintheme
if [ ! -d "$BASEPATH" ]; then
    mkdir $BASEPATH;
fi
cp -fR src/* $BASEPATH; 
