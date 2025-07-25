# LeasdOnHub

## Description
This project offers a comprehensive solution for Task Manamgen.

## Requirements
- Composer [`2.2`]
- Docker [`26.1`]

## Installation
1. Clone the repository: `git clone https://github.com/VictorWillBS/petiko-todo.git`
2. Navigate to the project directory: `cd petiko-todo`
3. Install the dependencies: `composer install`
4. Copy the configuration file: `cp .env.example .env`
5. Configure the `.env` file with your database and other necessary settings.

## Initial Setup
1. Start sail containers: `sudo ./vendor/bin/sail up -d`
2. Access the mysql container: `sudo docker-compose exec mysql bash`
3. Inside container add a mysql config running: `echo "sql_require_primary_key=0" >> /etc/my.cnf`
4. Exit container: `exit`
5. Stop sail containers: `sudo ./vendor/bin/sail stop`
6. Restart sail containers: `sudo ./vendor/bin/sail up -d`
7. Run the migrates: `sudo ./vendor/bin/sail artisan migrate`

## Basic Usage
1. Start sail containers: `sudo ./vendor/bin/sail up -d`
2. Start front-end application: `sudo ./vendor/bin/sail npm run dev`
3. Access the project by: `http://localhost`

### Using Asynchronous Jobs
If you need to use jobs and schedules jobs, you must to follow this step:
1. Follow the Basic Usage steps.
2. Start the horizon: `sudo ./vendor/bin/sail artisan horizon`
3. Start the schedule: `sudo ./vendor/bin/sail artisan schedule:work`

### Troubleshooting
If you got a `EACCES: permission denied` error, you must change the project fold permission. Follow this steps:

1. Go to the project fold parent
2. Change the permission: `sudo chmod 777 petiko-todo/node_modules/` or `sudo chmod 777 -R petiko-todo/node_modules/` (recursively)
3. try to run the front-end app again: `sudo ./vendor/bin/sail npm run dev`

## Testing

### Back-end
- **Running All Tests**
    - Run the command: `sudo ./vendor/bin/sail artisan test`.

- **Running One Test**
    - Run the command: `sudo ./vendor/bin/sail artisan test --filter <test file name without extension>`.

- **Running Test With Coverage Results**
    - Run the command: `sudo ./vendor/bin/sail artisan test --coverage`.

### Front-end
- **Running All Tests**
    - Run the command: `sudo ./vendor/bin/sail npm run test`.

## Warnings

- By default filesystem operations operate over public disk. If your operation manipulates a non public file/dir be sure to choose the appropriate disk.
