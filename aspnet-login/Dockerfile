FROM mcr.microsoft.com/dotnet/sdk:8.0 AS build

# Specify working directory for the project
WORKDIR /app

# Copy project files to container and restore dependencies
COPY ["aspnet-login.csproj", "./"]

# Copy the entire source code into the container
COPY . .

# build app
RUN dotnet build "aspnet-login.csproj" -c Release -o /app/build

# Publish app
RUN dotnet publish "aspnet-login.csproj" -c Release -o /app/publish

# Create final container containing built application
FROM mcr.microsoft.com/dotnet/aspnet:8.0 AS final
WORKDIR /app

# Copy the build from the previous step into the container
COPY --from=publish /app/publish .

EXPOSE 80

ENTRYPOINT ["dotnet", "aspnet-login.dll"]
