# uni_cms
My CMS project using codeigniter


如果使用的apache服务器，请务必开启rewrite模块！

如果使用的IIS服务器，请务必开启ISAPI_Rewrite！并将以下规则写入到其中！

[ISAPI_Rewrite]
RewriteRule /(?:index\.php|download|install|images|css|js|fonts)/(.*) $0 [I,L]  
RewriteRule /(.*) /index.php/$1 [I,L]
