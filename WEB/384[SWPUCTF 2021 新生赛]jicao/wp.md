![](./Snipaste_2026-04-08_16-47-27.png)
- 该挑战为PHP代码审计类题目，需同时满足POST和GET参数条件

- 通过阅读网页信息，可以看出是要求你通过POST请求传递一个id为"wllmNB"参数的同时，通过get请求也传递一个json格式的参数

- 创建python脚本添加post和get参数
![](./Snipaste_2026-04-08_16-48-01.png)

- 使用bp修改post并添加id行
![](./bp方法.png)