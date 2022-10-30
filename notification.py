#!/usr/bin/env python
import time
from plyer import notification
 
class Notify():
  def __init__(self, product, amount):
    self.product = product
    self.amount = amount

  def notify(self):
    if __name__=="__main__":
      notification.notify(
        title = self.product,
        message="Finishes in "+str(self.amount)+"days" ,      
        # displaying time
        timeout=2
      )
      # waiting time
      time.sleep(7)

Notify("soap", 3).notify()