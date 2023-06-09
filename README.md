# KookWebhook
基于kook的webhook的一个简单实现（PHP）
为了帮助更多萌新小白搭建属于自己的kook机器人（使用Webhook连接）
## 所需准备
### 服务器一台、kook开发者平台
## 步骤1
### 登陆kook开发者平台，创建一个应用，找到侧边栏的“机器人”点击，会选择机器人连接方式，这里选择Webhook（注意：Webhook和Websocket两者只能选一者进行连接，不能同时连接），记住自己的Token和Verify Key（不要泄露！）
### 请仔细阅读官方文档https://developer.kookapp.cn/doc/reference和https://developer.kookapp.cn/doc/webhook （肯定读不很懂）
### 在有了一定的理解后，再看此教程会豁然开朗
## 步骤2
### 在你的服务器上搭建一个站点，并删除站点根目录所有文件，上传本开源库里的index.php文件
### 然后回到kook开发者平台，在Callback URL一栏填写你的站点的网址（有端口的要加上端口，并且要在后面加上/?compress=0,这里代表发送数据无压缩（认真看第二个文档的就知道，kook传输时进行了压缩））（例如：http://xxx.xxx.xxx.xx:8080/?compress=0)
### 然后点击重试，直到提示你操作成功
# 注意！源码内有注释解释每一个的意思，通俗易懂，有任何bug可以提交pr或者issues，本文仅作为一个webhook的一个简单实现，更多功能可以自行参照kook官方api进行开发
