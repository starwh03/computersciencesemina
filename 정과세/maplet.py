from flask import Flask
from flask import request
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
import time
from bs4 import BeautifulSoup
chrome_options = webdriver.ChromeOptions()
chrome_options.add_argument('--headless')
chrome_options.add_argument('--no-sandbox')
chrome_options.add_argument('--disable-dev-shm-usage')
application = Flask(__name__)

@application.route('/')
def hello():

	email = request.args.get('email','choewuheon@naver.com')
	pw = request.args.get('pw','yuxian0903')

	wd = webdriver.Chrome('chromedriver',chrome_options=chrome_options)
	wd.get("https://nxlogin.nexon.com/common/login.aspx")

	send_id = wd.find_element_by_id("txtNexonID")
	send_id.send_keys(email)

	send_pw = wd.find_element_by_id("txtPWD")
	send_pw.send_keys(pw)

	wd.find_element_by_id("btnLogin").click()

	try:
		WebDriverWait(wd, 3).until(EC.alert_is_present())
		logout = wd.switch_to_alert()
		logout.accept()
		logout.dismiss()

	except:
		pass

	wd.get("https://maplestory.nexon.com/Home/Main")
	t = wd.find_element_by_xpath('//*[@id="section02"]/div/div[2]/span/a').get_attribute('href')
	wd.get(t)
	wd.find_element_by_xpath('//*[@id="container"]/div[2]/div[1]/ul/li[3]/a').click()
	li = wd.find_element_by_class_name('item_pot')
	li = li.find_elements_by_css_selector('li')

	ret = []

	for temp in li:
		full = {}

		if temp.find_elements_by_css_selector('span') == []:
			ret.append(full)
			continue

		temp.click()
		html = wd.page_source

		soup = BeautifulSoup(html,'html.parser')

		try:
			WebDriverWait(wd, 3).until(EC.presence_of_element_located((By.CLASS_NAME, "item_info")))
			img_link = soup.find("div",{"class":"item_img"})
			name = soup.find("div",{"class":"item_memo_title"})

			full["img"] = str(img_link)
			full["name"] = str(name)

			try:
				star = name.find("em").text
				star = star[:-4]
				full["star"] = star
			except:
				pass

			try:
				req = soup.find_all("div",{"class":"ablilty02"})
				full["req1"] = str(req[0])
				full["req2"] = str(req[1])
			except:
				pass

			try:
				l = soup.select("#container > div.con_wrap > div.contents_wrap > div > div.tab01_con_wrap > div.item_info > div > div.stet_info > ul > li")
				info = []
				k = 0

				for i in l:
					k = k + 1
					ta = i.find_all("div")
					ta = [str(ta[0]),str(ta[1])]
					info.append(ta)

				full["info"] = info
			except:
				pass
		except:
			pass

		ret.append(full)

	wd.quit()

	return str(ret)

if __name__ == "__main__":
	application.run()
