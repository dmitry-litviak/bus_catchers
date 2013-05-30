<div class="span12" id="divMain">

    <div style="text-align:center">
        <h1>Web Scrapping</h1>  
    </div>

    <hr />
    <div class="well well-large justified">
        <p>The act of retrieving data from websites is known as webscraping.  BusCatchers uses the python modules  <a href="http://docs.seleniumhq.org/"> Selenium </a> and  <a href="http://scrapy.org/"> Scrapy </a> to achieve its webscraping objectives.      
        </p>
        <p>The following python script is a highly condensed version of how the code actually works.  It can be run in the command line as: 
        </p>
        <p> >>> python < location of get_bolt.py ></p>
        <p>In order for this script to work, you will need to have downloaded Selenium and Scrapy.  This is a breeze to do.  There is a fair amount of support for Scrapy available online.  Selenium, on the other hand, has just the minimum amount of documentation available for it to be useful.  Nevertheless, BusCatchers owes its existence to Selenium.  It is a brilliant of free software that enables savvy users to accurately mimic human interaction with web browsers.
        </p>

    </div>
    <h2>get_bolt.py</h2>
    <pre class="prettyprint" id="python">
#!/usr/bin/python2.4
# stripped down BoltBus script 
from selenium import webdriver
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.support.ui import WebDriverWait 
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.keys import Keys
from scrapy.selector import HtmlXPathSelector
from scrapy.http import Response 
from scrapy.http import TextResponse 
import time

# set dates, origin, destination 
cityOrigin="Baltimore"
cityDeparture="New York"
day_array=[0]
browser = webdriver.Firefox()

# we are going the day of the days of the month from 15,16,...,25
# there is a discrepancy between the index of the calendar days and the day itself: for example day[10] may correspond to Feb 7th
for day in day_array:

	# Create a new instance of the Firefox driver
	browser.get("http://www.boltbus.com")
	
	# click on "region" tab
	elem_0=browser.find_element_by_id("ctl00_cphM_forwardRouteUC_lstRegion_textBox")
	elem_0.click()
	time.sleep(5) 
	
	# select Northeast
	elem_1=browser.find_element_by_partial_link_text("Northeast")
	elem_1.click()
	time.sleep(5)
	
	# click on origin city
	elem_2=browser.find_element_by_id("ctl00_cphM_forwardRouteUC_lstOrigin_textBox")
	elem_2.click()
	time.sleep(5)
	
	# select origin city
	elem_3=browser.find_element_by_partial_link_text(cityOrigin)
	elem_3.click()
	time.sleep(5)
	
	# click on destination city 
	elem_4=browser.find_element_by_id("ctl00_cphM_forwardRouteUC_lstDestination_textBox")
	elem_4.click()
	time.sleep(5)
	
	# select destination city 
	elem_5=browser.find_element_by_partial_link_text(cityDeparture)
	elem_5.click()
	time.sleep(5)
	
	# click on travel date
	travel_date_elem=browser.find_element_by_id("ctl00_cphM_forwardRouteUC_imageE")
	travel_date_elem.click()	
	
	# gets day rows of table
	date_rows=browser.find_elements_by_class_name("daysrow") 
	
	# select actual day (use variable day)
	# NOTE: you must make sure these day elements are "clickable"
	days=date_rows[0].find_elements_by_xpath("..//td")
	days[day].click()
	time.sleep(3) 
	
	# retrieve actual departure date from browser
	depart_date_elem=browser.find_element_by_id("ctl00_cphM_forwardRouteUC_txtDepartureDate")
	depart_date=str(depart_date_elem.get_attribute("value"))
	
	# PARSE TABLE
	
	# convert html to "nice format"
	text_html=browser.page_source.encode('utf-8')
	html_str=str(text_html)
	
	# this is a hack that initiates a "TextResponse" object (taken from the Scrapy module)
	resp_for_scrapy=TextResponse('none',200,{},html_str,[],None)
	
	# takes a "TextResponse" object and feeds it to a scrapy function which will convert the raw HTML to a XPath document tree
	hxs=HtmlXPathSelector(resp_for_scrapy)
	
	# the | sign means "or"
	table_rows=hxs.select('//tr[@class="fareviewrow"] | //tr[@class="fareviewaltrow"]')
	row_ct=len(table_rows)
	
	for x in xrange(row_ct):
		
		cur_node_elements=table_rows[x]
		travel_price=cur_node_elements.select('.//td[@class="faresColumn0"]/text()').re("\d{1,3}\.\d\d")
		
		# I use a mixture of xpath selectors to get me to the right location in the document, and regular expressions to get the exact data
		
		# actual digits of time 
		depart_time_num=cur_node_elements.select('.//td[@class="faresColumn1"]/text()').re("\d{1,2}\:\d\d")
		
		# AM or PM (time signature)
		depart_time_sig=cur_node_elements.select('.//td[@class="faresColumn1"]/text()').re("[AP][M]")
		
		# actual digits of time 
		arrive_time_num=cur_node_elements.select('.//td[@class="faresColumn2"]/text()').re("\d{1,2}\:\d\d")
		
		# AM or PM (time signature)
		arrive_time_sig=cur_node_elements.select('.//td[@class="faresColumn2"]/text()').re("[AP][M]")
		
		print "Depart date: " + depart_date
		print "Depart time: " + depart_time_num[0] + " " + depart_time_sig[0]	
		print "Arrive time: " + arrive_time_num[0] + " " + arrive_time_sig[0]
		print "Cost: " + "$" + travel_price[0] 
		print "\n"
    </pre>
</div>