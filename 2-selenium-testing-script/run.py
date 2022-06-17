import time
from selenium import webdriver
from datetime import date, datetime
import csv
import os
import time
options = webdriver.ChromeOptions()
options.add_argument("--start-maximized")

driver = webdriver.Chrome(chrome_options=options) 
driver.get('http://www.localhost/Hotel_Info_With_Google_Map/admin_login.php')


today = date.today()

path, dirs, files = next(os.walk("Testing_Reports"))
file_count = len(files)

file_count = file_count + 1

	
testing_report_name = "Testing_Reports/Testing_Report-{} ({}).txt".format(file_count,today)

testing_report = open(testing_report_name, "w")

with open(testing_report_name, "a") as myfile:
 	 myfile.write("The Testing Started on {}\n".format(datetime.now().strftime('%H:%M:%S')))
 	 myfile.write("================================")
 	 myfile.write("\n")
 	 myfile.write("\n")


usernameText = driver.find_element_by_name("username")
usernameText.click()
usernameText.send_keys('guna')

passwordText = driver.find_element_by_name("pass")
passwordText.click();
passwordText.send_keys("kuna123")

submutButton = driver.find_element_by_name("sub").click();

with open(testing_report_name, "a") as myfile:
 	 myfile.write("The system was logged in on {}\n".format(datetime.now().strftime('%H:%M:%S')))
 	 myfile.write("\n")

	
registerHotel = driver.find_element_by_xpath("/html[1]/body[1]/div[1]/div[1]/div[2]/ul[1]/li[2]/a[1]/p[1]").click()
       
with open(testing_report_name, "a") as myfile:
	myfile.write("The Regiser Hotel module was clicked on {}\n".format(datetime.now().strftime('%H:%M:%S')))
	myfile.write("\n")


hotelData = 1

with open('data.csv') as csvfile:
    readCSV = csv.reader(csvfile, delimiter=',')
    for row in readCSV:
        driver.find_element_by_name("hotel_name").send_keys(row[0])
        driver.find_element_by_name("address").send_keys(row[1])
        driver.find_element_by_name("district").send_keys(row[2])
        driver.find_element_by_name("email").send_keys(row[3])
        driver.find_element_by_name("phone").send_keys(row[4])
        driver.find_element_by_name("website").send_keys(row[5])
        driver.find_element_by_name("latitude").send_keys(row[6])
        driver.find_element_by_name("longitude").send_keys(row[7])
        
        des = open("Hotel_Description/{}.txt".format(row[8]),"r") 
        driver.find_element_by_name("description").send_keys(des.read())

        driver.find_element_by_name("sub").click();

        with open(testing_report_name, "a") as myfile:
        	myfile.write("Data {} has been Inserted\n".format(hotelData))
        	myfile.write("\n")

        hotelData += 1

modifyHotel = driver.find_element_by_xpath("/html[1]/body[1]/div[1]/div[1]/div[2]/ul[1]/li[3]/a[1]/p[1]").click()

time.sleep(3)

driver.find_element_by_name("update").click() 
name = driver.find_element_by_name("hotel_name")
name.clear()
name.send_keys("Ocean Bay Surf")

phone = driver.find_element_by_name("phone")
phone.clear()
phone.send_keys("0756800519")

driver.find_element_by_name("sub").click()

with open(testing_report_name, "a") as myfile:
	myfile.write("The Modify Module was Passed on {}\n".format(datetime.now().strftime('%H:%M:%S')))
	myfile.write("\n")


	




   


