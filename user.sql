-- Создание таблицы "Факультеты"
CREATE TABLE Faculties (
    FacultyID INT AUTO_INCREMENT PRIMARY KEY,
    FacultyName VARCHAR(100)
);

-- Создание таблицы "Группы"
CREATE TABLE Groups (
    GroupID INT AUTO_INCREMENT PRIMARY KEY,
    GroupNumber VARCHAR(50),
    FacultyID INT,
    FOREIGN KEY (FacultyID) REFERENCES Faculties(FacultyID)
);

-- Создание таблицы "Места практики"
CREATE TABLE PracticePlaces (
    PracticePlaceID INT AUTO_INCREMENT PRIMARY KEY,
    PlaceName VARCHAR(255),
    City VARCHAR(100)
);

-- Создание таблицы "Студенты"
CREATE TABLE Students (
    StudentID INT AUTO_INCREMENT PRIMARY KEY,
    LastName VARCHAR(255),
    BirthYear INT,
    Gender VARCHAR(10),
    GroupID INT,
    AverageGrade FLOAT,
    FOREIGN KEY (GroupID) REFERENCES Groups(GroupID)
);

-- Создание таблицы "Распределение студентов"
CREATE TABLE StudentPlacement (
    PlacementID INT AUTO_INCREMENT PRIMARY KEY,
    StudentID INT,
    PracticePlaceID INT,
    FOREIGN KEY (StudentID) REFERENCES Students(StudentID),
    FOREIGN KEY (PracticePlaceID) REFERENCES PracticePlaces(PracticePlaceID)
);

-- Заполение таблиц
-- Заполнение таблицы Faculties
INSERT INTO Faculties (FacultyName) VALUES ('ПМ');
INSERT INTO Faculties (FacultyName) VALUES ('АВТ');

-- Заполнение таблицы Groups
INSERT INTO Groups (GroupNumber, FacultyID) VALUES ('СГУАВТ-23', 2);
INSERT INTO Groups (GroupNumber, FacultyID) VALUES ('СГУАВТ-21', 2);
INSERT INTO Groups (GroupNumber, FacultyID) VALUES ('СГУПМ-13', 1);
INSERT INTO Groups (GroupNumber, FacultyID) VALUES ('СГУПМ-15', 1);
INSERT INTO Groups (GroupNumber, FacultyID) VALUES ('СГУАВТ-25', 2);

-- Заполнение таблицы PracticePlaces
INSERT INTO PracticePlaces (PlaceName, City) VALUES ('Станция по засеву облаков', 'Солнечный Город');
INSERT INTO PracticePlaces (PlaceName, City) VALUES ('Цветочногородская мастерская', 'Цветочный Город');
INSERT INTO PracticePlaces (PlaceName, City) VALUES ('Змеввский песчанный пляж', 'Змеевка');

-- Заполнение таблицы Students
INSERT INTO Students (LastName, BirthYear, Gender, GroupID, AverageGrade) VALUES ('Винтиков', 2003, 'М', 3, 87);
INSERT INTO Students (LastName, BirthYear, Gender, GroupID, AverageGrade) VALUES ('Кубышкина', 2002, 'Ж', 5, 65);
INSERT INTO Students (LastName, BirthYear, Gender, GroupID, AverageGrade) VALUES ('Снежинкина', 2004, 'Ж', 1, 53);
INSERT INTO Students (LastName, BirthYear, Gender, GroupID, AverageGrade) VALUES ('Растеряйкин', 2003, 'М', 2, 91);
INSERT INTO Students (LastName, BirthYear, Gender, GroupID, AverageGrade) VALUES ('Шпунтиков', 2001, 'М', 4, 78);
INSERT INTO Students (LastName, BirthYear, Gender, GroupID, AverageGrade) VALUES ('Знайкин', 2004, 'М', 5, 72);
INSERT INTO Students (LastName, BirthYear, Gender, GroupID, AverageGrade) VALUES ('Пилюлькин', 2002, 'М', 2, 59);
INSERT INTO Students (LastName, BirthYear, Gender, GroupID, AverageGrade) VALUES ('Кнопочкина', 2001, 'Ж', 4, 96);
INSERT INTO Students (LastName, BirthYear, Gender, GroupID, AverageGrade) VALUES ('Синеглазкина', 2003, 'Ж', 1, 84);
INSERT INTO Students (LastName, BirthYear, Gender, GroupID, AverageGrade) VALUES ('Тюбиков', 2002, 'М', 3, 63);

-- Заполнение таблицы StudentPlacement
INSERT INTO StudentPlacement (StudentID, PracticePlaceID) VALUES (9, 3);
INSERT INTO StudentPlacement (StudentID, PracticePlaceID) VALUES (2, 2);
INSERT INTO StudentPlacement (StudentID, PracticePlaceID) VALUES (4, 1);
INSERT INTO StudentPlacement (StudentID, PracticePlaceID) VALUES (6, 1);
INSERT INTO StudentPlacement (StudentID, PracticePlaceID) VALUES (7, 2);
INSERT INTO StudentPlacement (StudentID, PracticePlaceID) VALUES (1, 3);
INSERT INTO StudentPlacement (StudentID, PracticePlaceID) VALUES (10, 1);
INSERT INTO StudentPlacement (StudentID, PracticePlaceID) VALUES (5, 3);
INSERT INTO StudentPlacement (StudentID, PracticePlaceID) VALUES (8, 2);
INSERT INTO StudentPlacement (StudentID, PracticePlaceID) VALUES (3, 1);








