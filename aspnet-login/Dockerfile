# Stage 1: Build the application
FROM mcr.microsoft.com/dotnet/sdk:8.0 AS build
WORKDIR /app

# Copy solution file and project file to restore dependencies
COPY aspnet-login.csproj ./
RUN dotnet restore

# Copy the rest of the application files
COPY . ./
RUN dotnet publish -c Release -o out

# Stage 2: Set up the runtime environment
FROM mcr.microsoft.com/dotnet/aspnet:8.0 AS runtime
WORKDIR /app

# Copy the built application from the build stage
COPY --from=build /app/out ./

# Expose the port your application listens on (default is 80)
EXPOSE 80

# Specify the entry point for the application
ENTRYPOINT ["dotnet", "aspnet-login.dll"]
