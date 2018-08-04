#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <unistd.h>

int		main(int argc, char **argv)
{
//	char *command1 = "identify -format \'%[EXIF:*]\' "
//	char *img = argv[1];
//	char *command2 = " | grep \".*Latitude=.*\\|.*Longitude=.*\"";
	
	FILE *fp;
	char path[1035];
	char *res;

//	system("./img_gps.sh ../photo.jpg");
	res = (char *)malloc(sizeof(char) * 1032);
	fp = popen("./img_gps.sh ../photo.jpg", "r");
	if (fp == NULL)
	{
		printf("Failed to run command\n");
		exit(1);
	}
	while (fgets(path, sizeof(path)-1, fp) != NULL)
	{
		res = strcat(res, path);
	}
	printf("%s", res);
	pclose(fp);
	return (0);
}
