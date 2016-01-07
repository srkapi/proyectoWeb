contador=0;

echo "{\"medidas:\":[" > medidas;

while [ $contador -lt 10 ]
do
	FECHA_COMPLETA=`date "+%d/%m/%Y %H:%M:%S"`
	TEMPERATURA=`echo $((RANDOM%50))`
	HUMEDAD=`echo $((50+RANDOM%40))`
	if [ $contador -eq 9 ]
	then echo "{\"id\":\"$contador\", \"temperatura\":\"$TEMPERATURA\", \"humedad\":\"$HUMEDAD\", \"fecha\":\"$FECHA_COMPLETA\"}" >> medidas;
   	else echo "{\"id\":\"$contador\", \"temperatura\":\"$TEMPERATURA\", \"humedad\":\"$HUMEDAD\", \"fecha\":\"$FECHA_COMPLETA\"}," >> medidas;
   	fi
   	contador=`expr $contador + 1`
   	sleep 2;
done

echo "]}" >> medidas;

mv medidas medidas.json