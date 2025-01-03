# Build stage
FROM mcr.microsoft.com/dotnet/sdk:8.0 AS build

# Specify working directory for the project
WORKDIR /app

# Copy project files to container and restore dependencies
COPY ["aspnet-login.csproj", "./"]

# Copy the entire source code into the container
COPY . .

# Build app
RUN dotnet build "aspnet-login.csproj" -c Release -o /app/build

# Publish app
RUN dotnet publish "aspnet-login.csproj" -c Release -o /app/publish

# Final stage
FROM mcr.microsoft.com/dotnet/aspnet:8.0 AS final
WORKDIR /app

# Copy the build from the previous step into the container
COPY --from=build /app/publish .

# Expose port 80
EXPOSE 80

# Set the entrypoint for the application
ENTRYPOINT ["dotnet", "aspnet-login.dll"]
