# 说明文档

## 场景说明

本项目为电子科技大学中山学院 CTF 校队（ZSCTF）的新版考勤系统，支持签到、请假以及请假消息 Push 等功能，更多功能将在后期继续补充。

## 许可协议

MIT License

## 声明

您可以 Fork 代码进行二次开发，毕竟项目使用 MIT 协议开源。如果您在生产环境中能标注项目来源就更棒啦！

## 技术交流

项目内包含本人的邮箱，可以通过该邮箱联系本人。

## 开发的环境

+ Nginx - Tengine 2.2
+ PHP 7.4
+ MySQL 5.6
+ Redis 6.2

## 安装教程

+ 上传源码到您的服务器，解压；
+ 新建数据库，将解压目录下的 install.sql 导入；
+ 打开解压目录下的 config 目录，connect_sql.php 为数据库配置文件，wxwork_config.php 为请假消息 Push 的配置文件，Push 基于企业微信。
+ 配置完成后即可访问测试，默认管理员账户为【12345678900】，默认管理员密码为【12345678】。

## 企业微信 Push 使用说明

+ 电脑访问“企业微信”官网，并注册一个企业，这个是免费的，放心食用；
+ 手机下载“企业微信”客户端，使用绑定的微信登录，用于后续接收 Secret 操作；
+ 电脑进入企业后台，点击【应用管理】栏目，拉下去，点击【自建】里的【创建应用】；
+ 上传一个您喜欢的图标，并填写好应用名称等信息；
+ 进入应用详情，可以直接获得应用 id（AgentID），点击获取应用 secret（Secret），将把 secret 发送到企业微信手机端，您在手机端点击即可查看并复制；
+ 在企业后台点击【我的企业】，把页面拉到底部，即可获得企业 ID；
+ 在侧栏选择【微信插件】，打开您的个人微信，扫描页面上的二维码关注即可；
+ 操作完成，测试无误后可以卸载企业微信手机端。

## 项目文件结构

[ 主目录 ]

| = ( admin ) // 管理员后台

| | | - adminlist.php // 管理员列表

| | | - checklist.php // 自定义日期段查询

| | | - dailylist.php // 今日签到

| | | - delete.php // 删除用户

| | | - index.php // 管理主页

| | | - memberlist.php // 成员列表

| | | - regist.php // 注册

| | | - signedlist.php // 签到详情

| = ( auth ) // 登录相关模块

| | | - login.php // 登录

| | | - logout.php // 注销

| | | - pend.php // 登录信息比对

| | | - reset.php // 重置密码

| = ( config ) // 配置文件

| | | - connect_sql.php // 数据库连接

| | | - wxwork_config.php // 企业微信配置

| = ( function ) // 功能模块

| | | - customquery.php // 自定义日期段查询依赖

| | | - qrcodeget.php // 获取签到二维码

| | | - tokenset.php // 生成 token 并写入 sql

| = ( leave ) // 请假模块

| | | - func.php // 主要数据处理

| | | - function.php // 连接处理

| | | - index.php // 请假页面

| | | - mod.php // Push 消息点击查看的页面

| = ( member ) // 成员主页

| | | - gosigned.php // 签到的指引页

| | | - index.php // 成员登录后的主页

| | | - signed.php // 签到页面，需要搭配 token 使用

| = ( require ) // 主要的一些依赖

| | | - ( css ) ( Fonts ) ( icons ) ( js ) // mdui 前端依赖

| | | - count.php // 签到统计

| | | - custcount.php // 自定义时间段的签到统计

| | | - person.php // 成员查询

| | | - person2.php // 管理员查询

| | | - qrcode.php // 生成二维码依赖

| | | - repeat.php // 重复查询

| | | - token.php // 生成 token 依赖

| - index.php // 站点的主页

| - install.sql // 需要导入的数据库文件

| - README.md // 本说明文档

## 写在最后

如果您喜欢本项目，不妨点个 Star 支持一下？