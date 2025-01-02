using Microsoft.AspNetCore.Mvc;
using Newtonsoft.Json;
using System.Collections.Generic;
using System.IO;
using aspnet_login.Models;
using System;

namespace aspnet_login.Controllers
{
    public class LoginController : Controller
    {
        private string usersFile = Path.Combine(Directory.GetCurrentDirectory(), "App_Data", "users.json");

        // Get the list of users from the JSON file
        private List<User> GetUsers()
        {
            if (System.IO.File.Exists(usersFile))
            {
                var json = System.IO.File.ReadAllText(usersFile);
                return JsonConvert.DeserializeObject<List<User>>(json) ?? new List<User>();
            }
            return new List<User>();
        }

        // Save the list of users into the JSON file
        private void SaveUsers(List<User> users)
        {
            var json = JsonConvert.SerializeObject(users, Formatting.Indented);
            System.IO.File.WriteAllText(usersFile, json);
        }

        // Show the login/signup page
        [HttpGet]
        public IActionResult Index()
        {
            return View();
        }

        // Handle login process
        [HttpPost]
        public IActionResult Index(string action, string email, string username, string password)
        {
            Console.WriteLine($"HttpPost Index action: {action}, email: {email}, username: {username}, password: {password}");
            var users = GetUsers();
            if (action == "login")
            {
                var user = users.Find(u => u.Email == email && u.Password == password);
                if (user != null)
                {
                    ViewBag.Message = "Login successful!";
                    Console.WriteLine("Login successful!");
                    return View();
                }
                ViewBag.Message = "Invalid email or password!";
                Console.WriteLine("Invalid email or password!");
            }
            else if (action == "signup")
            {
                // Check if the email already exists
                if (users.Exists(u => u.Email == email))
                {
                    ViewBag.Message = "Email already exists.";
                    Console.WriteLine("Email already exists.");
                    return View();
                }

                // Add the new user to the list
                var newUser = new User { Email = email, Username = username, Password = password };
                users.Add(newUser);

                // Save the updated list to the JSON file
                SaveUsers(users);

                ViewBag.Message = "Sign up successful!";
                Console.WriteLine("Sign up successful!");
                return View();
            }

            Console.WriteLine("No action is valid");

            return View();
        }

        // Action for login2
        [HttpGet]
        public IActionResult Login2()
        {
            return View();
        }

        [HttpPost]
        public IActionResult Login2(string action, string email, string username, string password)
        {
            Console.WriteLine($"HttpPost Login2 action: {action}, email: {email}, username: {username}, password: {password}");
            var users = GetUsers();
            if (action == "login")
            {
                var user = users.Find(u => u.Email == email && u.Password == password);
                if (user != null)
                {
                    ViewBag.Message = "Login successful!";
                    Console.WriteLine("Login successful!");
                    return View();
                }
                ViewBag.Message = "Invalid email or password!";
                Console.WriteLine("Invalid email or password!");
            }
            else if (action == "signup")
            {
                // Check if the email already exists
                if (users.Exists(u => u.Email == email))
                {
                    ViewBag.Message = "Email already exists.";
                    Console.WriteLine("Email already exists.");
                    return View();
                }

                // Add the new user to the list
                var newUser = new User { Email = email, Username = username, Password = password };
                users.Add(newUser);

                // Save the updated list to the JSON file
                SaveUsers(users);

                ViewBag.Message = "Sign up successful!";
                Console.WriteLine("Sign up successful!");
                return View();
            }

            return View();
        }
    }
}
