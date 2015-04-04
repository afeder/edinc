#!/usr/bin/python
import sys
import os
import json

input = json.load(sys.stdin)
path = input.get("path")
args = input.get("args")
env = input.get("env")

os.execve(path, args, env)
