for i in *;
  do echo $i;
  if [ $i != "config.sh" ]; then
       if [ $i != "sketch.hex" ]; then 
       echo "pasando por aqui"
       rm sketch.hex;
       cp $i sketch.hex;
       rm $i;
       fi
  fi
done


