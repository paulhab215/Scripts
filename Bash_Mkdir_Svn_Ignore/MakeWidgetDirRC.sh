#!/bin/bash
for d in *; do
  mkdir "/home/accounts/$d/dashboard/FailedDT"
  svnadd="svn add /home/accounts/$d/dashboard/FailedDT"
  eval $svnadd
  
  cd "/home/accounts/$d/dashboard/FailedDT"
  svnprop="svn propset svn:ignore * ."
  eval $svnprop
  
done
