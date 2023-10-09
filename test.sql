USE [AVA]
GO
select mensaje from plantilla where id = 5346
DECLARE	@return_value int,
		@res varchar(max)

EXEC	@return_value = [dbo].[enviarWhatsAppBtn]
		@Celular = N'573182491757',
		@encabezado = N'Conculdata',
		@plantilla = N'prueba',
		@id_mensaje = 5346,
		@id_numero = 2003,
		@res = @res OUTPUT

SELECT	@res as N'@res'

SELECT	'Return Value' = @return_value

GO
