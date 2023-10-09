
DECLARE @id as int,@Celular AS nvarchar(20),@Nombre as nvarchar(200),@mes as varchar(20),@fec_evento as varchar(50)
DECLARE ProdInfo CURSOR FOR select id,Celular,NOMBRE,MES,FECHA_EVENTO from Tabla_Wabs_Cumple where mes = 'diciembre' and GRUPO = 2  and [status] is null order by id
OPEN ProdInfo
FETCH NEXT FROM ProdInfo INTO @id,@Celular,@Nombre,@mes,@fec_evento
WHILE @@fetch_status = 0
BEGIN
    DECLARE	@return_value int,
		@res varchar(max),
		@variables varchar(max) = ',
            {
                "type": "body",
                "parameters": [
                    {
                        "type": "text",
                        "text": "' + @Nombre + '"
                    },
                    {
                        "type": "text",
                        "text": "' + @mes + '"
                    },
                    {
                        "type": "text",
                        "text": "' + @fec_evento + '"
                    }
                    
                ]
            }',@url as varchar(max) = N'http://drive.google.com/uc?export=view&id=1Pd780PXIjjk9Fo_sjZT7B1bXxXFY4PNR'

EXEC	@return_value = [dbo].[enviarWhatsAppImage] @Celular, 'fiesta_diciembre', @url,@variables,@res = @res OUTPUT

SELECT	@res as N'@res'
update Tabla_Wabs_Cumple set [status] = @res where id = @id

SELECT	'Return Value' = @return_value
    FETCH NEXT FROM ProdInfo INTO @id,@Celular,@Nombre,@mes,@fec_evento
END
CLOSE ProdInfo
DEALLOCATE ProdInfo