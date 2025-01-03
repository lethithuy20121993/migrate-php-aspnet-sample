FROM mcr.microsoft.com/dotnet/aspnet:8.0

COPY . /app

WORKDIR /app
RUN dotnet restore
RUN dotnet build

EXPOSE 80

ENTRYPOINT ["dotnet", "aspnet-login.dll"]
