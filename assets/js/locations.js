var locations = [
["ปุณณสิริ โฮมเพลส2", "137 ถ.ปุณณกัณฑ์ ต.คอหงส์ อ.หาดใหญ่", "฿4,500,000-฿8,580,000", 6.998597, 100.510112, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "79"],
["ปุณณสิริ โฮมเพลส", "ถ.ปุณณกัณฑ์ ต.คอหงส์ อ.หาดใหญ่", "฿3,900,000-฿7,500,000", 6.999682, 100.506302, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "78"],
["กาญจนทรัพย์", "ถ.กาญจนวณิชย์ ต.บ้านพรุ อ.หาดใหญ่", "฿2,890,000-฿6,900,000", 6.919482, 100.469099, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "77"],
["บ้านทานตะวัน", "ถ.ทวีรัตน์ ต.คอหงส์ อ.หาดใหญ่", "฿1,990,000-฿22,000,000", 6.992833403513809, 100.50467038657757, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "76"],
["วอเตอร์ ฟรอนต์ วิลเลจ", "ต.คอหงส์ อ.หาดใหญ่", "฿0-฿0", 6.994305013043554, 100.51202219245147, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "75"],
["บ้านสายชล", "ต.หาดใหญ่ อ.หาดใหญ่", "฿0-฿0", 6.940526, 100.399935, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "74"],
["พลัสทาวน์โฮม หาดใหญ่", "96 ซ.10 ถ.เพชรเกษม ต.คอหงส์ อ.หาดใหญ่", "฿3,900,000-฿7,400,000", 7.025818979366013, 100.4817126527787, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "73"],
["พลัสคอนโดมิเนียม หาดใหญ่ 2", "255 ถ.ราษฎร์อุทิศ ต.หาดใหญ่ อ.หาดใหญ่", "฿1,590,000-฿4,670,000", 7.0042, 100.4612, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "72"],
["พลัสคอนโดมิเนียม หาดใหญ่ 1", "ซ.เพชรเกษ ถ.เพชรเกษม ต.หาดใหญ่ ", "฿1,490,000-฿3,500,000", 7.0213, 100.4878, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "71"],
["ไพรวิลเลจ (Privillage)", "ถ.นวลแก้วอุทิศ ต.หาดใหญ่ อ.หาดใหญ่", "฿8,400,000-฿8,800,000", 7.028928, 100.485790, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "70"],
["อิงกมล-ปุณณกัณฑ์ 2 เฟส 2", "ม.6 ถ.ปุณณกัณฑ์ ต.ทุ่งใหญ่ อ.หาดใหญ่", "฿3,995,000-฿6,158,000", 7.001789, 100.499244, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "69"],
["หงส์ฟ้าคอนโดเทล", "ซ.2 ถ.เพชรเกษม ต.หาดใหญ่ อ.หาดใหญ่", "฿1,400,000-฿2,100,000", 7.019645, 100.493109, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "68"],
["พราววิลเลจ ม.อ. ทุ่งงาย", "44 ถ.ปุณณกัณฑ์ ต.คอหงส์ อ.หาดใหญ่", "฿4,200,000-฿4,500,000", 6.987272, 100.487476, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "67"],
["The Best Condo", "555/1 ถ.กาญจนวณิชย์ ต.คอหงส์ อ.หาดใหญ่", "฿1,490,000-฿2,790,000", 6.994307698394688, 100.49280004077377, "properties-detail.php", "assets/img/properties/prop_id_66.jpg", "assets/img/property-types/single-family.png", "66"],
["Prompt Condominium", "ซ.ทวดดำอุ ถ.ทุ่งรีโคกวัด ต.คอหงส์ ", "฿1,950,000-฿8,000,000", 6.9981840000812365, 100.50260300000002, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "65"],
["เดอะแกรนด์วังหงส์", "ม.2 ถ.เพชรเกษม ต.คอหงส์ อ.หาดใหญ่", "฿15,900,000-฿15,900,000", 7.025496, 100.493824, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "64"],
["ฮาร์โมนีวิลล์ 2", "ถ.ปลักธง-ควนจง ต.คอหงส์ อ.หาดใหญ่", "฿3,800,000-฿4,500,000", 6.974881, 100.498728, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "63"],
["นิวโฮมแกรนด์วิลล์", "ถ.ควนจง-ปลักธง ต.คอหงส์ อ.หาดใหญ่", "฿0-฿0", 6.973864647699934, 100.50036558980946, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "62"],
["อารยากรีนฮิลล์", "ถ.ทวีรัตน์ ต.คอหงส์ อ.หาดใหญ่", "฿0-฿0", 6.9900068369365105, 100.5233754553642, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "61"],
["บีนูเรสสิเด็นซ์", "158 ม.8 ถ.ปุณณกัณฑ์ ต.คอหงส์ อ.หาดใหญ่", "฿2,900,000-฿6,800,000", 6.999167404466188, 100.51563416931151, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "60"],
["บีเบิร์ด แก้มลิง 2", "ถ.ทวีรัตน์ ต.คอหงส์ อ.หาดใหญ่", "฿6,900,000-฿8,000,000", 6.993485650701488, 100.51167392324828, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "59"],
["มอนทาน่า (MONTANA)", "1400 ถ.กาญจนวณิชย์-ทุ่งโดน ต.คอหงส์ ", "฿18,000,000-฿26,000,000", 6.992849553069838, 100.52083624998477, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "58"],
["The TWINS", "ถ.นวลแก้ว ต.หาดใหญ่ อ.หาดใหญ่", "฿7,390,000-฿7,390,000", 7.030354745276551, 100.49657737665177, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "57"],
["บ้านรุ่งทิวา S20", "ถ.ซอย 20 คลองเตย ต.คอหงส์ อ.หาดใหญ่", "฿4,900,000-฿7,800,000", 7.0362, 100.4855, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "56"],
["บ้านรุ่งทิวาปาร์ค", "313/2 ถ.วงศ์วานิชญ์ ต.หาดใหญ่ อ.หาดใหญ่", "฿6,990,000-฿7,490,000", 7.0141, 100.4892, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "55"],
["Commune Hatyai", "ถ.นวลแก้ว ต.หาดใหญ่ อ.หาดใหญ่", "฿3,590,000-฿5,390,000", 7.0304, 100.4968, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "54"],
["City Resort Pasawang", "35 ถ.ภาสว่าง 3 ต.หาดใหญ่ อ.หาดใหญ่", "฿1,370,000-฿4,300,000", 7.0216, 100.4904, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "53"],
["The Rise Residence", "11 ถ.ประชายินดี ต.หาดใหญ่ อ.หาดใหญ่", "฿2,400,000-฿12,000,000", 7.007122, 100.487897, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "52"],
["แก้วไพริน 1", "ต.หาดใหญ่ อ.หาดใหญ่", "฿2,900,000-฿3,500,000", 6.9379, 100.3727, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "51"],
["A-Time Condominium", "ถ.ตรงข้าม รพ.กรุงเทพฯ ต.หาดใหญ่ ", "฿990,000-฿3,500,000", 7.0176, 100.4860, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "50"],
["เดอะพาร์ค เรสซิเดนส์ คอนโดมิเนียม", "ถ.กาญจนวณิชย์ ต.หาดใหญ่ อ.หาดใหญ่", "฿1,750,000-฿6,270,000", 7.036562, 100.502199, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "49"],
["บ้านนันทิชา", "ม.5 ถ.ร่วมอุทิศ ต.คลองแห อ.หาดใหญ่", "฿2,230,000-฿3,050,000", 6.992721036402867, 100.52082537763215, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "48"],
["เดอะพีโอนี่ คอนโดมิเนียม", "131 ถ.วงศ์วานิช ต.หาดใหญ่ อ.หาดใหญ่", "฿1,490,000-฿3,300,000", 7.014413716223235, 100.48874180769917, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "47"],
["สันติบุรี มาสเตอร์พีซ", "ถ.ราษฏร์อุทิศ 32/1 ต.หาดใหญ่ อ.หาดใหญ่", "฿6,000,000-฿7,000,000", 7.0228949117725765, 100.45656289085207, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "46"],
["นีโอสมาร์ท ปุณณกันต์", "ถ.ปุณณกันต์ ต.คอหงส์ อ.หาดใหญ่", "฿3,800,000-฿4,500,000", 6.994193387280329, 100.50493715911739, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "45"],
["บ้านประกายทองวิลล์", "168 ม.1 ถ.พรุฉิมพลี 2 ต.ควนลัง อ.หาดใหญ่", "฿0-฿0", 6.9987840, 100.4235920, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "44"],
["กรีนเพลส ควนลัง", "182 ม.2 ถ.เพชรเกษม ต.ควนลัง อ.หาดใหญ่", "฿0-฿0", 6.99432, 100.42399, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "43"],
["Harry", "ถ.เลี่ยงเมือง 43 ต.ควนลัง อ.หาดใหญ่", "฿8,700,000-฿15,600,000", 6.984688, 100.447005, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "42"],
["แก้วไพริน 3", "ถ.หลังกองบิน 56 ต.ควนลัง อ.หาดใหญ่", "฿0-฿0", 6.92172, 100.39453, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "41"],
["ปาล์มสปริง 11", "ถ.ชัยชนะสงคราม ต.ควนลัง อ.หาดใหญ่", "฿0-฿0", 6.95718, 100.42615, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "40"],
["ปาล์มสปริง 7", "ม.1 ถ.ชัยชนะสงคราม ต.ควนลัง อ.หาดใหญ่", "฿0-฿0", 6.9598, 100.42443, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "39"],
["ปาล์มสปริง แกรนวิลล์", "ถ.ลพบุรีราเมศวร์-สนามบิน ต.ควนลัง ", "฿0-฿0", 6.97079, 100.42979, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "38"],
["The MUSE", "1216 ม.2 ถ.เลียบคลองชลประทาน ต.ควนลัง ", "฿1,890,000-฿3,990,000", 6.99345, 100.41235, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "37"],
["พรรณพฤกษา", "1901 ม.6 ถ.สนามบิน-ลพบุรีราเมศวร์ ", "฿0-฿0", 6.95216, 100.41859, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "36"],
["เออบาน่า (Urbana)", "ถ.สนามบิน ต.ควนลัง อ.หาดใหญ่", "฿3,800,000-฿7,400,000", 6.95326, 100.41906, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "35"],
["อภิไพบูลย์ทรัพย์", "1919/33 ม.6 ถ.สนามบิน ต.ควนลัง อ.หาดใหญ่", "฿2,250,000-฿2,250,000", 6.95069, 100.41739, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "34"],
["วิลลาจิโอ้ (Villagio)", "ถ.ลพบุรีราเมศวร์-สนามบิน ต.ควนลัง ", "฿4,700,000-฿5,400,000", 6.98175, 100.42626, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "33"],
["บ้านสวนวงษ์ทอง 3", "665/18 ม.1 ถ.ฐานุดมอนุสรณ์ ต.ควนลัง ", "฿0-฿0", 6.97901, 100.44212, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "32"],
["บ้านสวนวงษ์ทอง 2", "665/18 ม.1 ถ.ฐานุดมอนุสรณ์ ต.ควนลัง ", "฿0-฿0", 6.9786, 100.44056, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "31"],
["บ้านสวนวงษ์ทอง", "665/18 ม.1 ถ.ฐานุดมอนุสรณ์ ต.ควนลัง ", "฿0-฿0", 6.97951, 100.44203, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "30"],
["The Patio Village", "ถ.กาญจนวณิชย์ ต.หาดใหญ่ อ.หาดใหญ่", "฿0-฿0", 6.99598, 100.487844, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "28"],
["สิริสัมพันธ์", "ถ.บ้านโป๊ะหมอ ต.บ้านพรุ อ.หาดใหญ่", "฿5,500,000-฿5,500,000", 6.943817, 100.471103, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "27"],
["กรีนเพลส-บ้านพรุ", "93 ถ.กาญจนวณิชย์ ต.บ้านพรุ อ.หาดใหญ่", "฿4,500,000-฿13,000,000", 6.964492, 100.477096, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "26"],
["เดอะ คาแนลวิลเลจ", "ม.7 ถ.หาดใหญ่-จะนะ ต.คอหงส์ อ.หาดใหญ่", "฿6,500,000-฿6,900,000", 6.96805556, 100.50305556, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "24"],
["บ้านแฝดเพชรไพลิน", "ม.7 ถ.หาดใหญ่-จะนะ ต.คอหงส์ อ.หาดใหญ่", "฿5,900,000-฿7,900,000", 6.96944444, 100.49916667, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "23"],
["พราววิลเลจ บ้านพรุ", "ต.บ้านพรุ อ.หาดใหญ่", "฿2,400,000-฿3,500,000", 6.960466, 100.465812, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "22"],
["พฤกษาวิลล์ 3", "ถ.บ้านพรุธานี ต.บ้านพรุ อ.หาดใหญ่", "฿2,900,000-฿4,900,000", 6.933924, 100.448861, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "21"],
["บ้านชมกรีนวิว", "ถ.บ้านพรุธานี ต.บ้านพรุ อ.หาดใหญ่", "฿1,990,000-฿4,590,000", 6.935882, 100.455796, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "20"],
["ดิ ออกซิเจน", "27 ถ.กาญจนวณิชย์ ต.คอหงส์ อ.หาดใหญ่", "฿12,900,000-฿17,900,000", 6.989862, 100.492297, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "19"],
["วิรากร คลาสสิค", "70 ถ.เอเชีย ต.บ้านพรุ อ.หาดใหญ่", "฿4,500,000-฿4,500,000", 6.972065, 100.487543, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "18"],
["บ้านสวนวังนนท์", "269 ถ.บ้านพรุธานี ต.บ้านพรุ อ.หาดใหญ่", "฿2,900,000-฿7,300,000", 6.934608, 100.454071, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "17"],
["ดิ โอทาวน์", "ถ.กาญจนวณิชย์ ต.บ้านพรุ อ.หาดใหญ่", "฿5,000,000-฿5,590,000", 6.928393, 100.468630, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "16"],
["ดิ แอทริบิว", "64/141 ถ.กาญจนวณิชย์ ต.คอหงส์ อ.หาดใหญ่", "฿990,000-฿4,590,000", 7.03500000, 100.50027778, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "15"],
["นีโอสมาร์ท บิ๊กซีเอ๊กซ์ตร้า", "ม.1 ถ.ทุ่งรวงทอง ต.คอหงส์ อ.หาดใหญ่", "฿3,500,000-฿4,100,000", 7.031108, 100.486528, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "14"],
["นีโอสมาร์ท คลองหวะ", "ถ.อิสรภาพ 2 ต.คอหงส์ อ.หาดใหญ่", "฿2,500,000-฿4,500,000", 6.972639, 100.474699, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "13"],
["นีโอสมาร์ท บ้านพรุ", "ถ.กาญจนวณิชย์ ต.บ้านพรุ อ.หาดใหญ่", "฿2,100,000-฿5,000,000", 6.9369332, 100.4683856, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "12"],
["นีโอสมาร์ท พรุธานี", "ถ.บ้านพรุธานี ต.บ้านพรุ อ.หาดใหญ่", "฿5,500,000-฿15,100,000", 6.939991, 100.46805, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "11"],
["ปาล์มสปริงส์ 10", "ถ.พรุค้างคาว ต.บ้านพรุ อ.หาดใหญ่", "฿2,880,000-฿4,850,000", 6.919888, 100.464337, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "10"],
["ปาล์มสปริงส์ 9", "ถ.กาญจนวณิชย์ ต.บ้านพรุ อ.หาดใหญ่", "฿3,410,000-฿6,270,000", 6.937516, 100.470499, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "9"],
["ปาล์มสปริงส์ 8", "ถ.คลองยาเหนือ 9 ต.บ้านพรุ อ.หาดใหญ่", "฿1,850,000-฿4,470,000", 6.946448, 100.478788, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "8"],
["เบญจพร คลองหวะ", "ถ.หาดใหญ่-ปัตตานี ต.คอหงส์ อ.หาดใหญ่", "฿2,800,000-฿7,200,000", 6.97265833, 100.48944444, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "7"],
["อาเซียน ซิตี้ รีสอร์ท", "ถ.กาญจนวณิชย์ ต.หาดใหญ่ อ.หาดใหญ่", "฿1,900,000-฿4,700,000", 6.99421639292247, 100.48569084018823, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "6"],
["ฉัตรทองพาวิลเลี่ยน 5 เฟส 2", "ถ.เยื้องสนามกีฬาพรุค้างคาว ต.บ้านพรุ ", "฿3,500,000-฿4,500,000", 6.919672, 100.459116, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "5"],
["ฮาร์โมนีวิลล์ 3", "ถ.บ้านโป๊ะหมอ ต.บ้านพรุ อ.หาดใหญ่", "฿2,420,000-฿5,200,000", 6.932496, 100.469295, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "4"],
["ฮาร์โมนีวิลล์ 1", "ต.บ้านพรุ อ.หาดใหญ่", "฿1,690,000-฿5,490,000", 6.963813, 100.475182, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "3"],
["ฮาร์โมนีบิซ", "ต.บ้านพรุ อ.หาดใหญ่", "฿2,800,000-฿8,870,000", 6.966122, 100.475611, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "2"],
["ปิยะทรัพย์ บ้านไร่", "88/5 ม.8 ถ.บ้านไร่-ทุ่งขมิ้น ต.บ้านพรุ ", "฿1,790,000-฿2,800,000", 6.896111, 100.476111, "properties-detail.php", "assets/img/properties/property-sample.jpg", "assets/img/property-types/single-family.png", "1"]
];