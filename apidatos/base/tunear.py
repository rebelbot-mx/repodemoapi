import os

baseDir = os.getcwd()
    
templateArchivo =  open('diccionario.html', 'r')

cadena = templateArchivo.read()

templateArchivo.close()

t1 = cadena.replace('Column',  'Columna')
t2 = t1.replace('Type',  'Tipo')
t3 = t2.replace('Null',  'Nulo')
t4 = t3.replace('Comments',  'Comentarios')
t5 = t4.replace('Comment',  'Comentario')
t6 = t5.replace('Keyname',  'Nombre de la Llave')


file_name = baseDir + '/diccionarioApiAldeas.html'
print("filename :" , file_name)
#file_name = 'actions.js'
f = open(file_name,mode= 'a+',encoding ='utf-8')  # open file in append mode
f.write(t6)
f.close()
