
try_again = "y"
vowels = "aeiou"

while try_again == "y":
    phrase = str(input("\n\n Type a phrase: "))

    for word in phrase.split():
        if(word[0] in vowels):
            pig_latin = word + "way"
        else:
            pig_latin = word[1:] + word[0] + "ay"
        
        print(pig_latin)

    try_again = input("\n\n Try again? Press Y to continue or N to quit")
    if try_again.lower() == "n":
        break
        