clear all
close all

x = double(imread('Mask.jpg'));
figure,imshow(x/255);
y = x;
a = zeros(300,500);
a(100:250,100:350) = 1;
figure,imshow(a)
save m.dat a -ascii


% Water Marking
x1 = x(:,:,1);
x2 = x(:,:,2);
x3 = x(:,:,3);

dx1 = dct2(x1) ; dx11 = dx1;
dx2 = dct2(x2) ; dx22 = dx2;
dx3 = dct2(x3) ; dx33 = dx3;

load m.dat 
g = 10;

[rm,cm] = size(m);
dx1(1:rm,1:cm) = dx1(1:rm,1:cm) + g * m;
dx2(1:rm,1:cm) = dx2(1:rm,1:cm) + g * m;
dx3(1:rm,1:cm) = dx3(1:rm,1:cm) + g * m;

figure,imshow(dx1);
figure,imshow(dx2);
figure,imshow(dx3);

y1 = idct2(dx1);
y2 = idct2(dx2);
y3 = idct2(dx3);

y(:,:,1) = y1;
y(:,:,2) = y2;
y(:,:,3) = y3;

figure,imshow(y1);
figure,imshow(y2);
figure,imshow(y3);
figure,imshow(y);
figure ; imshow(y/255);
figure ; imshow(abs(y-x)*100);

z = y;
[r,c,s] = size(x);

y = z;
dy1 = dct2(y(:,:,1)) ;
dy2 = dct2(y(:,:,2)) ;
dy3 = dct2(y(:,:,3)) ;

dy1(1:rm,1:cm) = dy1(1:rm,1:cm) - g * m ;
dy2(1:rm,1:cm) = dy2(1:rm,1:cm) - g * m ;
dy3(1:rm,1:cm) = dy3(1:rm,1:cm) - g * m ;

y11 = idct2(dy1);
y22 = idct2(dy2);
y33 = idct2(dy3);

yy(:,:,1) = y11;
yy(:,:,2) = y22;
yy(:,:,3) = y33;

figure ; imshow(y/255)
figure ; imshow(abs(yy-x)*10000)